<?
class ProductsController extends SiteController {
	const PER_PAGE = 10000;

	var $components = array('articles.PCArticle', 'grid.PCGrid');
	var $helpers = array('core.PHA', 'core.PHCore', 'Time', 'core.PHTime', 'articles.HtmlArticle', 'ArticleVars');
	var $uses = array('category.Category', 'articles.Article', 'media.Media', 'seo.Seo', 'SiteArticle');

	var $categoryID = '';

	function beforeFilter() {
		parent::beforeFilter();

		// Configure::write('Config.language', 'rus');
		$this->Article = $this->SiteArticle; // что работало все, что написано для Article в самом плагине

		App::import('Helper', 'articles.PHTranslit');
		App::import('Helper', 'Router');
		$this->Router = new RouterHelper();

		$this->Router->PHTranslit = new PHTranslitHelper();
		$this->categoryID = (isset($this->params['category']) && $this->params['category']) ? $this->getCategoryID($this->params['category']) : '';
	}

	function beforeRenderLayout() {
		$this->set('objectType', 'products');
		parent::beforeRenderLayout();
	}

	private function getCategoryID($category) {
		return str_replace('-', '', strrchr($category, '-'));
	}

	function index() {
		if ($this->categoryID != 20) {
			$this->redirect('/aksessuary-20/subcategories/');
		}
		$this->grid['SiteArticle'] = array(
			'conditions' => array('Article.object_type' => 'subcategories', 'Article.published' => 1, 'Article.category_id' => $this->categoryID),
			'fields' => array('Category.id', 'Category.title', 'Article.object_type', 'Article.title', 'Article.teaser', 'Article.featured', 'Article.price', 'Article.page_id'),
			'order' => array('Article.featured' => 'desc', 'Article.sorting' => 'asc'),
			'limit' => self::PER_PAGE
		);
		$aFilters = $this->_getFilters();
		$aArticles = $this->PCGrid->paginate('SiteArticle');
		$this->set('aArticles', $aArticles);
		$this->set('aFilters', $aFilters);

		$this->aBreadCrumbs = array('/' => 'Главная', 'Акксессуары');
		$this->pageTitle = 'Акксессуары';
		$page_title = 'Акксессуары';

		$this->set('page_title', $page_title);
		$this->set('showAcsCategories', true);
		//$this->set('aAcsCategories', $this->Article->getOptions('subcategories'));
		$this->set('aAcsCategories', $this->Article->find('all', array('conditions' => array('Article.object_type' => 'subcategories', 'Article.published' => 1))));

		$content = $this->SiteArticle->findByPageId('akksessuary');
		$content['Seo'] = $this->Seo->defaultSeo($content['Seo'],
			$content['Article']['title'],
			'акксессуары, свадебные акксессуары',
			'купить свадебные акксессуары в магазине '.DOMAIN_TITLE.' недорого'
		);
		$this->data['SEO'] = $content['Seo'];
		$this->set('content', $content);
	}

	function accessories() {
		if ($this->categoryID != 20) {
			$this->redirect('/aksessuary-20/subcategories/');
		}
		$aArticle = $this->PCArticle->view(str_replace('.html', '', $this->params['id']));
		$this->set('aArticle', $aArticle);

		$this->grid['SiteArticle'] = array(
			'conditions' => array('Article.object_type' => 'products', 'Article.published' => 1, 'Article.subcategory_id' => $aArticle['Article']['id']),
			'fields' => array('Category.id', 'Category.title', 'Article.object_type', 'Article.title', 'Article.teaser', 'Article.featured', 'Article.price', 'Article.page_id'),
			'order' => array('Article.featured' => 'desc', 'Article.sorting' => 'asc'),
			'limit' => self::PER_PAGE
		);

		$aFilters = $this->_getFilters();
		// $this->grid['SiteArticle']['conditions'] = array_merge($this->grid['SiteArticle']['conditions'], $aFilters['conditions']);

		$aArticles = $this->PCGrid->paginate('SiteArticle');
		$this->set('aArticles', $aArticles);
		$this->set('aFilters', $aFilters);

		$this->aBreadCrumbs = array(
			'/' => 'Главная',
			'/aksessuary-20/subcategories/' => 'Акксессуары',
			$aArticle['Article']['title']
		);
		$this->pageTitle = $aArticle['Article']['title'];
		$this->data['SEO'] = array(
			'keywords' => 'акксессуары, '.mb_strtolower($aArticle['Article']['title']),
			'descr' => 'купить '.mb_strtolower($aArticle['Article']['title']).' магазине '.DOMAIN_TITLE.' недорого'
		);

		$page_title = 'Акксессуары';

		/*
		if (isset($this->params['url']['data']['filter']['Article.brand_id']) && $this->params['url']['data']['filter']['Article.brand_id']) {
			$brandID = $this->params['url']['data']['filter']['Article.brand_id'];
			$brand = $this->Article->findById($brandID);
			$page_title = $brand['Article']['title'];
		} elseif (isset($this->params['url']['data']['filter']['Article.object_id']) && $this->params['url']['data']['filter']['Article.object_id']) {
			$categoryID = $this->params['url']['data']['filter']['Article.object_id'];
			$category = $this->Category->findById($categoryID);
			$page_title = $category['Category']['title'];
		}*/
		$this->set('page_title', $page_title);
		$this->set('showAcsCategories', true);
		$this->set('aAcsCategories', $this->Article->find('all', array('conditions' => array('Article.object_type' => 'subcategories', 'Article.published' => 1))));
	}


	function view() {
		$aArticle = $this->SiteArticle->findById($this->params['id']);
		if (!$aArticle) {
			$this->redirect('/pages/nonExist');
		}

		unset($aArticle['Media']);
		$aArticle['Media'] = $this->Media->getMedia('Article', $aArticle['Article']['id']);

		$aArticle['Collection'] = $this->Article->findById($aArticle['Article']['collection_id']);
		$aArticle['Brand'] = $this->Article->findById($aArticle['Article']['brand_id']);
		$aArticle['Subcategory'] = $this->Article->findById($aArticle['Article']['subcategory_id']);
		$this->set('aArticle', $aArticle);

		$aCategoryOptions = $this->Category->getOptions('brands');
		$categoryTitle = ($this->categoryID) ? $aCategoryOptions[$this->categoryID] : 'Платье';

		if ($this->categoryID == 20) {
			$this->set('showAcsCategories', true);
			$this->set('aAcsCategories', $this->Article->find('all', array('conditions' => array('Article.object_type' => 'subcategories', 'Article.published' => 1))));

			$aSubcategory = $aArticle['Subcategory'];
			$subcategoryTitle = ($aSubcategory) ? $aSubcategory['Article']['title'] : '';

			$this->aBreadCrumbs = array(
				'/' => 'Главная',
				$this->Router->catUrl('subcategories', $aArticle['Category']) => $aArticle['Category']['title'],
				$this->Router->url($aSubcategory) => $subcategoryTitle,
				$aArticle['Article']['title']
			);

			$aArticle['Seo'] = $this->Seo->defaultSeo($aArticle['Seo'],
				$categoryTitle.' '.$subcategoryTitle.' '.$aArticle['Article']['title'],
				$categoryTitle.', '.$subcategoryTitle.', '.trim($aArticle['Article']['title']),
				'купить '.$subcategoryTitle.' в магазине '.DOMAIN_TITLE.' недорого'
			);
		} else {
			$this->_initSBCategories($this->categoryID);
			$brandTitle = trim($aArticle['Brand']['Article']['title']);
			$collectionTitle = trim($aArticle['Collection']['Article']['title']);
			$this->aBreadCrumbs = array(
				'/' => 'Главная',
				$this->Router->catUrl('brands', $aArticle['Brand']['Category']) => $aArticle['Brand']['Category']['title'],
				$this->Router->url($aArticle['Brand']) => $brandTitle,
				$this->Router->url($aArticle['Collection']) => $collectionTitle,
				$aArticle['Article']['title']
			);

			$aArticle['Seo'] = $this->Seo->defaultSeo($aArticle['Seo'],
				$categoryTitle.' '.$brandTitle.' коллекции '.trim($aArticle['Collection']['Article']['title']).' модель '.$aArticle['Article']['title'],
				$categoryTitle.', '.$brandTitle.', '.$collectionTitle.', '.trim($aArticle['Article']['title']),
				'купить платье '.trim($aArticle['Article']['title']).' из коллекции '.$brandTitle.' '.$collectionTitle.' в магазине '.DOMAIN_TITLE.' недорого'
			);
		}

		$this->pageTitle = (isset($aArticle['Seo']['title']) && $aArticle['Seo']['title']) ? $aArticle['Seo']['title'] : $aArticle['Article']['title'];
		$this->data['SEO'] = $aArticle['Seo'];
		$this->set('showMainCategories', true);
	}

	function activeProducts() {
		$this->grid['SiteArticle'] = array(
			'conditions' => array('Article.object_type' => 'products', 'Article.published' => 1, 'Article.is_active' => 1, 'Article.category_id' => array(18, 19)),
			'fields' => array('Category.id', 'Category.title', 'Article.object_type', 'Article.title', 'Article.teaser', 'Article.featured', 'Article.price', 'Article.is_active'),
			'order' => array('Article.featured' => 'desc', 'Article.modified' => 'desc'),
			'limit' => self::PER_PAGE
		);
		$aArticles = $this->PCGrid->paginate('SiteArticle');
		$this->set('aArticles', $aArticles);

		$aArticle = $this->Article->findByPageId('active-products');
		$aArticle['Seo'] = $this->Seo->defaultSeo($aArticle['Seo'],
			'Платья в наличии',
			'Платья в наличии',
			'купить платье в магазине '.DOMAIN_TITLE.' недорого'
		);
		$this->set('aArticle', $aArticle);
		$this->pageTitle = (isset($aArticle['Seo']['title']) && $aArticle['Seo']['title']) ? $aArticle['Seo']['title'] : $aArticle['Article']['title'];
		$this->data['SEO'] = $aArticle['Seo'];
	}

	function search() {
		$aFilters = $this->_getFilters();
		$aFilters['conditions'] = array_merge(array('Article.object_type' => 'products', 'Article.published' => 1), $aFilters['conditions']);
		$this->grid['SiteArticle'] = array(
			'conditions' => $aFilters['conditions'],
			'fields' => array('Category.id', 'Category.title', 'Article.object_type', 'Article.title', 'Article.teaser', 'Article.featured', 'Article.is_active', 'Article.is_pending', 'Article.price', 'Article.price2'),
			'order' => array('Article.modified' => 'desc'),
			'limit' => self::PER_PAGE
		);
		$aArticles = $this->PCGrid->paginate('SiteArticle');
		$this->set('aArticles', $aArticles);

		$aFilters['data'] = (isset($this->params['url']['data']['filter'])) ? $this->params['url']['data']['filter'] : array();
		$this->set('aFilters', $aFilters);
	}

	private function _getFilters() {
		$filtersData = (isset($this->params['url']['data']['filter'])) ? $this->params['url']['data']['filter'] : array();
		$aConditions = array();
		$aURL = array();
		foreach($filtersData as $key => $value) {
			if ($value !== '') {
				if (is_array($value)) {
					foreach($value as $value1) {
						$aURL[] = 'data[filter]['.$key.'][]='.$value1;
					}
				} else {
					$aURL[] = 'data[filter]['.$key.']='.$value;
				}

				if ($key == 'price') {
					$aConditions['Article.price > '] = $value;
				} elseif ($key == 'price2') {
					$aConditions['Article.price < '] = $value;
				} elseif ($key == 'is_active') {
					$aConditions['OR'] = array('Article.featured' => 1, 'Article.is_active' => 1, 'Article.is_pending' => 1);
				} elseif ($key == 'title') {
					$aConditions['Article.title LIKE '] = $value.'%';
				} else {
					$aConditions[$key] = $value;
				}
			}
		}
		return array('conditions' => $aConditions, 'url' => implode('&', $aURL));
	}

}
