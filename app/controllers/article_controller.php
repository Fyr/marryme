<?
class ArticleController extends SiteController {
	const PER_PAGE = 10;

	var $name = 'Article';
	var $components = array('articles.PCArticle', 'grid.PCGrid', 'captcha.PCCaptcha', 'comments.PCComment', 'SiteComment');
	var $helpers = array('core.PHA', 'Time', 'core.PHTime', 'articles.HtmlArticle');
	var $uses = array('articles.Article', 'media.Media', 'stats.Stat', 'seo.Seo', 'tags.Tag', 'tags.TagObject', 'SiteArticle', 'category.Category', 'comments.Comment', 'Contact');

	var $Router;
	var $objectType = 'articles';
	var $aCatTitle = array(
			'articles' => 'Статьи',
			'news' => 'Новости',
			'brands' => 'Брэнды',
			'collections' => 'Коллекции',
			'photos' => 'Наши невесты',
			'products' => 'Каталог'
		);

	var $categoryID = '';

	function beforeFilter() {
		parent::beforeFilter();

		// Configure::write('Config.language', 'rus');
		$this->Article = $this->SiteArticle; // что работало все, что написано для Article в самом плагине

		App::import('Helper', 'articles.PHTranslit');
		App::import('Helper', 'Router');
		$this->Router = new RouterHelper();
		// $this->Router->checkPageParams();

		$this->Router->PHTranslit = new PHTranslitHelper();
	}

	private function getCategoryID($category) {
		return str_replace('-', '', strrchr($category, '-'));
	}

	function beforeFilterLayout() {
		parent::beforeFilterLayout();
		$this->objectType = $this->params['object_type'];
		if (!in_array($this->objectType, array('articles', 'news', 'photos', 'products', 'brands', 'collections'))) {
			$this->objectType = 'news';
		}

		$this->categoryID = (isset($this->params['category']) && $this->params['category']) ? $this->getCategoryID($this->params['category']) : '';
		$this->aBreadCrumbs = array('/' => 'Главная', $this->aCatTitle[$this->objectType]);
	}

	function beforeRenderMenu() {
		$this->currMenu = $this->objectType;
		if (in_array($this->objectType, array('brands', 'collections', 'products'))) {
			$this->currMenu = 'products';
		}
		parent::beforeRenderMenu();
	}

	function beforeRenderLayout() {
		$this->set('catTitle', $this->aCatTitle[$this->objectType]);
		if ($this->objectType == 'photos') {
			$aArticles = $this->SiteArticle->find('all', array('conditions' => array('Article.object_type' => 'photos')));
			$this->set('aCategories', $aArticles);
		} elseif ($this->objectType == 'brands') {
			// $this->set('aCategories', $this->Category->find('all', array('conditions' => array('object_type' => $this->objectType))));
		}
		$this->set('objectType', $this->objectType);
		parent::beforeRenderLayout();
	}

	function index() {
		$page_title = $this->aCatTitle[$this->objectType];
		$this->pageTitle = $this->aCatTitle[$this->objectType];

		$conditions = array('Article.object_type' => $this->objectType, 'Article.published' => 1);
		if ($this->objectType == 'brands') {
			$conditions['Article.object_id'] = $this->categoryID; // $this->params['category'];
			$this->_initSBCategories($this->categoryID);

			$aCategoryOptions = $this->Category->getOptions('brands');
			$this->aBreadCrumbs = array(
				'/' => 'Главная',
				/* '/product/' => 'Каталог', */
				/*'/brands/'.$this->params['category'] =>*/ $aCategoryOptions[$this->categoryID],
				/* __('Brands', true) */
			);
			$page_title = $aCategoryOptions[$this->categoryID];
			$this->pageTitle = $aCategoryOptions[$this->categoryID];

			$pageID = false;
			if ($this->categoryID == 18) {
				$pageID = 'svadebnye-platjya';
			} elseif ($this->categoryID == 19) {
				$pageID = 'vechernie-platja';
			}  elseif ($this->categoryID == 20) {
				$pageID = 'akksessuary';
			}
			if ($pageID) {
				$content = $this->Article->findByPageId($pageID);
				$this->set('content', $content);
				$content['Seo'] = $this->Seo->defaultSeo($content['Seo'],
					$content['Article']['title'],
					$aCategoryOptions[$this->categoryID],
					'купить '.mb_strtolower($aCategoryOptions[$this->categoryID], 'utf8').' в магазине '.DOMAIN_TITLE.' недорого'
				);
				$this->data['SEO'] = $content['Seo'];
			} else {
				$this->data['SEO'] = array(
					'keywords' => $aCategoryOptions[$this->categoryID],
					'descr' => 'купить '.mb_strtolower($aCategoryOptions[$this->categoryID], 'utf8').' в магазине '.DOMAIN_TITLE.' недорого'
				);
			}
			$this->set('showMainCategories', true);
		}

		$this->grid['SiteArticle'] = array(
			'conditions' => $conditions,
			'fields' => array('Category.id', 'Category.title', 'title', 'featured', 'body', 'teaser', 'page_id', 'object_type', 'created', 'modified', 'Stat.visited', 'Stat.comments', 'Stat.photos'),
			'order' => array('Article.created' => 'desc'),
			'limit' => self::PER_PAGE
		);

		$aArticles = $this->PCGrid->paginate('SiteArticle');
		$this->set('aArticles', $aArticles);
		$this->set('page_title', $page_title);
	}

	function view() {

		$aArticle = $this->PCArticle->view(str_replace('.html', '', $this->params['id']));
		if (!$aArticle) {
			$this->redirect('/pages/nonExist');
		}

		$articleID = $aArticle['Article']['id'];

		$this->SiteComment->listForm($articleID);

		unset($aArticle['Media']);
		$aArticle['Media'] = $this->Media->getMedia('Article', $articleID);

		$page_title = $aArticle['Article']['title'];

		if ($this->objectType == 'brands' || $this->objectType == 'collections') {
			$aCategoryOptions = $this->Category->getOptions('brands');
			$categoryTitle = ($this->categoryID) ? $aCategoryOptions[$this->categoryID] : 'Платье';
			if ($this->objectType == 'brands') {
				$aCollections = $this->Article->find('all', array('conditions' => array('Article.object_id' => $articleID, 'Article.published' => 1)));
				// $aCollections = $this->Article->findAllByObject_id($articleID);
				$this->set('aCollections', $aCollections);
				$categoryID = $aArticle['Article']['object_id'];

				$this->aBreadCrumbs = array(
					'/' => 'Главная',
					$this->Router->catUrl('brands', $aArticle['Category']) => $aArticle['Category']['title'],
					$aArticle['Article']['title']
				);
				$aArticle['Seo'] = $this->Seo->defaultSeo($aArticle['Seo'],
					$categoryTitle.' коллекции '.trim($aArticle['Article']['title']),
					$categoryTitle.', '.trim($aArticle['Article']['title']),
					'купить платье '.trim($aArticle['Article']['title']).' в магазине '.DOMAIN_TITLE.' недорого'
				);
			} elseif ($this->objectType == 'collections') {
				$page_title = 'Коллекция '.$aArticle['Article']['title'];
				$aProducts = $this->Article->find('all', array('conditions' => array('Article.object_id' => $articleID, 'Article.published' => 1), 'order' => array('Article.featured' => 'desc', 'Article.sorting' => 'asc')));
				$this->set('aProducts', $aProducts);

				$aBrand = $this->Article->findById($aArticle['Article']['object_id']);
				$this->set('aBrand', $aBrand);
				$categoryID = $aBrand['Article']['object_id'];
				$brandTitle = trim($aBrand['Article']['title']);

				$this->aBreadCrumbs = array(
					'/' => 'Главная',
					$this->Router->catUrl('brands', $aArticle['Category']) => $aBrand['Category']['title'],
					$this->Router->url($aBrand) => $brandTitle,
					$aArticle['Article']['title']
				);
				$aArticle['Seo'] = $this->Seo->defaultSeo($aArticle['Seo'],
					$categoryTitle.' '.$brandTitle.' коллекции '.trim($aArticle['Article']['title']),
					$categoryTitle.', '.$brandTitle.', '.trim($aArticle['Article']['title']),
					'купить платье '.$brandTitle.' из коллекции '.trim($aArticle['Article']['title']).' в магазине '.DOMAIN_TITLE.' недорого'
				);
				$aAnotherCollections = $this->Article->find('all', array('conditions' => array('Article.object_type' => 'collections', 'Article.object_id' => $aArticle['Article']['object_id'], 'Article.id <> '.$articleID, 'Article.published' => 1)));
				$this->set('aAnotherCollections', $aAnotherCollections);
			}
			if ($categoryID == 18 || $categoryID == 19) {
				$this->_initSBCategories($categoryID);
			}
			$this->set('showMainCategories', true);
		}

		if ($this->objectType == 'photos') {
			$this->aBreadCrumbs = array(
				'/' => 'Главная',
				'/photo/' => $this->aCatTitle[$this->objectType],
				$aArticle['Article']['title']
			);
		} elseif ($this->objectType == 'news') {
			$this->aBreadCrumbs = array(
				'/' => 'Главная',
				'/news/' => $this->aCatTitle[$this->objectType],
				'Просмотр новости'
			);
		} elseif ($this->objectType == 'articles') {
			$this->aBreadCrumbs = array(
				'/' => 'Главная',
				'/articles/' => $this->aCatTitle[$this->objectType],
				'Просмотр статьи'
			);
		}

		$this->pageTitle = (isset($aArticle['Seo']['title']) && $aArticle['Seo']['title']) ? $aArticle['Seo']['title'] : $aArticle['Article']['title'];
		$this->data['SEO'] = $aArticle['Seo'];
		$this->set('page_title', $page_title);
		$this->set('aArticle', $aArticle);

		$aRelatedTags = $this->TagObject->getRelatedTags('Article', $articleID);
		$this->set('aRelatedTags', $aRelatedTags);
		if ($aRelatedTags) {
			$aRelatedArticles = $this->SiteArticle->getRelatedObjects($aRelatedTags, $this->objectType, $articleID);
			$this->set('aRelatedArticles', $aRelatedArticles);
		}
	}
}
