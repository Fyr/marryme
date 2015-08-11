<?php
class SiteController extends AppController {
	// var $uses = array('articles.Article', 'SiteArticle');
	var $uses = array('category.Category');
	protected $Router;
	// ---------------------
	// Custom variables
	// ---------------------


	function beforeFilter() {
		App::import('Helper', 'articles.PHTranslit');
		App::import('Helper', 'Router');
		$this->Router = new RouterHelper();
		$this->Router->PHTranslit = new PHTranslitHelper();
		
		$this->beforeFilterMenu();
		$this->beforeFilterLayout();
	}

	/**
	 * Common code for setting up current menus and bottom links (for all controllers)
	 * Variables set here will be used when menus will be rendering
	 */
	function beforeFilterMenu() {
		$this->currMenu = ($this->params['controller'] == 'pages' || $this->params['controller'] == 'userarea') ? $this->params['action'] : $this->params['controller'];
		$this->currLink = $this->currMenu;
	}

	/**
	 * Common code for layout (for all controllers)
	 * Variables set here will be used when layout will be rendering
	 */
	function beforeFilterLayout() {
		// Code for layout
		$this->loadModel('articles.Article');
		$this->loadModel('category.Category');
		$this->loadModel('media.Media');
		$this->loadModel('SiteArticle');
		$this->Article = $this->SiteArticle;
	}

	function beforeRender() {
		$this->beforeRenderMenu();
		$this->beforeRenderLayout();
	}

	/**
	 * Override code here for layout in specific controller
	 *
	 */
	function beforeRenderLayout() {
		$this->set('errMsg', $this->errMsg);
		$this->set('aErrFields', $this->aErrFields);
		$this->set('aBreadCrumbs', $this->aBreadCrumbs);

		$this->Article = $this->SiteArticle;

		$aArticles = $this->Article->getRandomRows(4, array('Article.object_type' => 'articles', 'published' => 1, 'featured' => 1));
		// $aArticles = $this->Article->find('all', array('conditions' => array('Article.object_type' => 'articles', 'published' => 1), 'order' => array('Article.featured DESC', 'Article.id desc'), 'limit' => 4));
		$this->set('randomArticles', $aArticles);

		$aArticles = $this->Article->find('list', array('conditions' => array('Article.object_type' => 'news', 'published' => 1), 'order' => 'Article.id DESC', 'limit' => 5));
		$aEvents = $this->Article->getRandomRows(1, array('Article.id' => array_keys($aArticles)));
		$this->set('upcomingEvent', ($aEvents) ? $aEvents[0] : false);

		$aFeatured = $this->Article->getRandomRows(4, array('Article.object_type' => 'products', 'published' => 1, 'featured' => 1));
		$this->set('randomProducts', $aFeatured);
		$aID = array();
		foreach($aFeatured as $article) {
			$aID[] = $article['Article']['id'];
		}

		$aProducts = $this->Article->getRandomRows(4, array('Article.object_type' => 'products', 'published' => 1, 'is_new' => 1));
		$this->set('newProducts', $aProducts);

		$aProducts = $this->Article->getRandomRows(4, array('Article.object_type' => 'products', 'published' => 1, 'is_active' => 1, 'NOT' => array('Article.id' => $aID)));
		$this->set('activeProducts', $aProducts);

		$aProducts = $this->Article->getRandomRows(4, array('Article.object_type' => 'products', 'published' => 1, 'is_pending' => 1, 'NOT' => array('Article.id' => $aID)));
		$this->set('pendingProducts', $aProducts);

		$aSlider = $this->Media->find('all', array('conditions' => array('object_id' => PHOTOSLIDER_ID)));
		$this->set('aSlider', $aSlider);

		$aMainCategories = $this->Category->findAllByObjectType('brands');
		$this->set('aMainCategories', $aMainCategories);
		$this->set('showMainCategories', !$this->isHomePage());

		$aBrands = $this->Article->findAllByObjectType('brands');
		foreach($aBrands as $rec) {
			$aSearch['Brands'][$rec['Category']['id']][] = $rec;
		}
		// $aSearch['Brands'] = $aBrands;
		$this->set('aSearch', $aSearch);

		$this->loadModel('TagcloudLink');
		$this->set('aTags', $this->TagcloudLink->find('all'));
		
		$this->set('pronoviasW1', $this->Article->findById((TEST_ENV) ? 819 : 2056));
	}


/*
	function isEmailValid($email) {
		return strlen($email) < MAX_EMAIL_ADDR_LENGTH && preg_match(REGEX_EMAIL, $email);
	}

	function validateRequired($aRequired, &$data, $modelTitle, $fieldKeys = array()) {
		if (!$fieldKeys) {
			$fieldKeys = array_keys($aRequired);
		}
		foreach($fieldKeys as $key) {
			$data[$modelTitle][$key] = @trim($data[$modelTitle][$key]);
			if (!$data[$modelTitle][$key]) {
				$this->errMsg[] = 'Field "'.$aRequired[$key].'" is required';
			}
		}
		return !$this->errMsg;
	}
	*/
}

class AppController extends Controller {
	var $helpers = array('Html', 'Time', 'core.PHTime', 'core.PHA', 'core.PHCore', 'media.PHMedia', 'Router', 'ArticleVars', 'Price'); // , 'Mybbcode', 'Ia'

	var $errMsg = '';
	var $aErrFields = array();

	var $homePage = array('title' => 'Главная', 'href' => '/');
	var $currMenu = '', $currLink;

	var $pageTitle = '';

	var $aMenu = array(
		'news' => array('title' => 'Новости', 'href' => '/news/'),
		'products' => array('title' => 'Каталог', 'href' => '/sitemap/'),
		'feedback' => array('title' => 'Отзывы', 'href' => '/feedback/'),
		'photos' => array('title' => 'Наши невесты', 'href' => '/photo/'),
		'articles' => array('title' => 'Статьи', 'href' => '/articles/'),
		'companies' => array('title' => 'Свадебные салоны', 'href' => '/svadebnye-salony-minsk/'),
		'brides' => array('title' => 'Невестам', 'href' => '/pages/show/brides'),
		'about-us' => array('title' => 'О салоне', 'href' => '/pages/show/about-us'),
		'contacts' => array('title' => 'Контакты', 'href' => '/contacts/')
	);

	var $aBottomLinks = array(
		'news' => array('title' => 'Новости', 'href' => '/news/'),
		'articles' => array('title' => 'Статьи', 'href' => '/articles/'),
		'products' => array('title' => 'Каталог', 'href' => '/svadebnye-platya/brands/'),
		'feedback' => array('title' => 'Отзывы', 'href' => '/feedback/'),
		'photos' => array('title' => 'Наши невесты', 'href' => '/photo/'),
		'companies' => array('title' => 'Свадебные салоны', 'href' => '/svadebnye-salony-minsk/'),
		'brides' => array('title' => 'Невестам', 'href' => '/pages/show/brides'),
		'about-us' => array('title' => 'О салоне', 'href' => '/pages/show/about-us'),
		'contacts' => array('title' => 'Контакты', 'href' => '/contacts'),
		'sitemap' => array('title' => 'Карта сайта', 'href' => '/sitemap/')
	);
	var $aBreadCrumbs = array();

	/**
	 * Override code here for menus in specific controller
	 *
	 */
	function beforeRenderMenu() {
		$this->pageTitle = ($this->pageTitle) ? $this->pageTitle.' - '.DOMAIN_TITLE : DOMAIN_TITLE;

		$this->set('pageTitle', $this->pageTitle);

		$this->set('aMenu', $this->aMenu);
		$this->set('currMenu', $this->currMenu);

		$this->set('aBottomLinks', $this->aBottomLinks);
		$this->set('currLink', $this->currLink);

		$this->set('homePage', $this->homePage);
		$this->set('isHomePage', $this->isHomePage());

		$this->errMsg = (is_array($this->errMsg)) ? implode('<br/>', $this->errMsg) : $this->errMsg;
		if ($this->errMsg) {
			$this->errMsg = '<br/>'.$this->errMsg.'<br/><br/>';
		}
		$this->set('errMsg', $this->errMsg);
		$this->set('aBreadCrumbs', $this->aBreadCrumbs);
	}

	function isHomePage() {
		return $this->params['url']['url'] == '/' || $this->params['url']['url'] == 'pages/home';
	}

	function _initSBCategories($categoryID = '') {
		$aCategoryOptions = $this->Category->getOptions('brands');
		$this->set('aCategoryOptions', $aCategoryOptions);

		$aBrands = $this->Article->find('all', array('conditions' => array('Article.object_type' => 'brands'), 'order' => 'Article.object_id'));
		$aBrandOptions = array();
		$aBrandCategories = array();
		foreach($aBrands as $item) {
			$aBrandCategories[$item['Article']['object_id']][] = $item['Article']['id'];
			$aBrandOptions[$item['Article']['id']] = $item['Article']['title'];
		}
		$this->set('aBrandCategories', $aBrandCategories);
		$this->set('aBrandOptions', $aBrandOptions);

		$aCollections = $this->Article->find('all', array('conditions' => array('Article.object_type' => 'collections', 'Article.published' => 1), 'order' => 'Article.object_id'));
		$aCollectionOptions = array();
		$aBrandCollections = array();

		foreach($aCollections as $item) {
			$brandID = $item['Article']['object_id'];
			if (!$categoryID || (isset($aBrandCategories[$categoryID]) && in_array($brandID, $aBrandCategories[$categoryID]))) {
				$aBrandCollections[$brandID][] = $item['Article']['id'];
			}
			$aCollectionOptions[$item['Article']['id']] = $item['Article']['title'];
		}
		$this->set('showSBCategories', true);
		$this->set('aBrandCollections', $aBrandCollections);
		$this->set('aCollectionOptions', $aCollectionOptions);

		$conditions = array('Article.object_type' => 'collections');
		if ($categoryID) {
			$conditions['Article.category_id'] = $categoryID;
		}
		$aCollections = $this->Article->find('all', array('conditions' => $conditions, 'order' => 'Article.brand_id'));
		$aCatCollections = array();
		foreach($aCollections as $item) {
			$aCatCollections[$item['Article']['id']] = $item;
		}
		$this->set('aCatCollections', $aCatCollections);
	}
	
	
	public function redirect($url, $status = null, $exit = true) {
		return parent::redirect($url, 301, $exit);
	}
	
	/**
	 * Проверить категорию и сделать редирект для старых урлов
	 *
	 * @return unknown
	 */
	protected function getCategoryID() {
		$category = (isset($this->params['category']) && $this->params['category']) ? $this->params['category'] : '';
		
		$url = '';
		if ($category == 'svadebnye-platjya-18') {
			$url = $this->Router->catUrl($this->params['object_type'], array('id' => 18, 'title' => '-'));
		} elseif ($category == 'vechernie-platjya-19') {
			$url = $this->Router->catUrl($this->params['object_type'], array('id' => 19, 'title' => '-'));
		} elseif ($category == 'aksessuary-20') {
			$url = $this->Router->catUrl($this->params['object_type'], array('id' => 20, 'title' => '-'));
		}
		if ($url) {
			if (isset($this->params['id']) && $this->params['id']) {
				$url.= '/'.$this->params['id'];
			}
			return $this->redirect($url);
		}
		
		if ($category == 'svadebnye-platya') {
			return 18;
		} elseif ($category == 'vechernie-platya') {
			return 19;
		} elseif ($category == 'svadebnye-aksessuary') {
			return 20;
		}
		return str_replace('-', '', strrchr($category, '-'));
	}
}
