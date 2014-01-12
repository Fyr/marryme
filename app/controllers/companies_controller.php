<?
class CompaniesController extends SiteController {
	const PER_PAGE = 1;

	var $components = array('articles.PCArticle', 'grid.PCGrid', 'comments.PCComment', 'SiteComment');
	var $helpers = array('core.PHA', 'core.PHCore', 'Time', 'core.PHTime', 'articles.HtmlArticle', 'ArticleVars');
	var $uses = array('category.Category', 'articles.Article', 'media.Media', 'seo.Seo', 'SiteArticle', 'comments.Comment', 'Contact', 'Company', 'SiteCompany');

	var $objectType = 'companies';

	function beforeFilter() {
		parent::beforeFilter();

		// Configure::write('Config.language', 'rus');
		App::import('Helper', 'articles.PHTranslit');
		App::import('Helper', 'Router');
		$this->Router = new RouterHelper();

		$this->Router->PHTranslit = new PHTranslitHelper();
	}

	function beforeRenderLayout() {
		$this->set('objectType', $this->objectType);
		parent::beforeRenderLayout();
	}

	function index() {
		$this->Article = $this->SiteCompany; // что работало все, что написано для Article в самом плагине
		$this->grid['SiteCompany'] = array(
			'conditions' => array('Article.object_type' => $this->objectType, 'Article.published' => 1),
			'fields' => array('Article.object_type', 'Article.title', 'Article.teaser', 'Article.featured', 'Company.id', 'Company.phones', 'Company.address', 'Company.work_time', 'Company.email', 'Company.site_url'),
			'order' => array('Article.featured' => 'desc', 'Article.created' => 'asc'),
			'limit' => self::PER_PAGE
		);
		$aArticles = $this->PCGrid->paginate('SiteCompany');
		$this->set('aArticles', $aArticles);

		$this->aBreadCrumbs = array('/' => 'Главная', __('Companies', true));
		$this->pageTitle = __('Companies', true);

		/*
		$content = $this->SiteArticle->findByPageId('akksessuary');
		$content['Seo'] = $this->Seo->defaultSeo($content['Seo'],
			$content['Article']['title'],
			'акксессуары, свадебные акксессуары',
			'купить свадебные акксессуары в магазине '.DOMAIN_TITLE.' недорого'
		);
		$this->data['SEO'] = $content['Seo'];
		$this->set('content', $content);
		*/
	}

	function view($id) {
		$this->Article = $this->SiteCompany; // что работало все, что написано для Article в самом плагине
		$aArticle = $this->SiteCompany->findById($id);
		if (!$aArticle) {
			$this->redirect('/pages/nonExist');
		}

		$articleID = $aArticle['Article']['id'];
		$this->SiteComment->listForm($articleID);

		unset($aArticle['Media']);
		$aArticle['Media'] = $this->Media->getMedia('Company', $aArticle['Article']['id']);

		$this->set('aArticle', $aArticle);

		$this->pageTitle = (isset($aArticle['Seo']['title']) && $aArticle['Seo']['title']) ? $aArticle['Seo']['title'] : $aArticle['Article']['title'];
		$this->data['SEO'] = $aArticle['Seo'];
		$this->aBreadCrumbs = array(
			'/' => 'Главная',
			'/companies/' => __('Companies', true),
			'Просмотр'
		);
	}

}
