<?
class CompaniesController extends SiteController {
	const PER_PAGE = 100;

	var $components = array('articles.PCArticle', 'grid.PCGrid', 'comments.PCComment', 'SiteComment', 'Email', 'SiteEmail');
	var $helpers = array('core.PHA', 'core.PHCore', 'Time', 'core.PHTime', 'articles.HtmlArticle', 'ArticleVars');
	var $uses = array('category.Category', 'articles.Article', 'media.Media', 'seo.Seo', 'SiteArticle', 'comments.Comment', 'Contact', 'Company', 'SiteCompany');

	var $objectType = 'companies';
	
	function beforeFilter() {
		$this->redirect('/');
	}

	function beforeRenderLayout() {
		$this->set('objectType', $this->objectType);
		parent::beforeRenderLayout();
	}

	function index() {
		$this->Article = $this->SiteCompany; // что работало все, что написано для Article в самом плагине
		$this->grid['SiteCompany'] = array(
			'conditions' => array('Article.object_type' => $this->objectType, 'Article.published' => 1),
			'fields' => array('Article.object_type', 'Article.page_id', 'Article.title', 'Article.teaser', 'Article.featured', 'Company.id', 'Company.phones', 'Company.address', 'Company.work_time', 'Company.email', 'Company.site_url'),
			'order' => array('Article.featured' => 'desc', 'Article.created' => 'asc'),
			'limit' => self::PER_PAGE
		);
		$aArticles = $this->PCGrid->paginate('SiteCompany');
		$this->set('aArticles', $aArticles);

		$content = $this->Article->findByPageId('companies');
		$content['Seo'] = $this->Seo->defaultSeo($content['Seo'],
			$content['Article']['title'],
			'свадебные салоны',
			'свадебные салоны на '.DOMAIN_TITLE
		);
		$this->data['SEO'] = $content['Seo'];
		if (isset($this->params['page']) && intval($this->params['page']) > 1) {
			// show relev.text only for 1st page
			$content = false;
		}
		$this->set('content', $content);
		
		$this->aBreadCrumbs = array('/' => 'Главная', $content['Article']['title']);
		$this->pageTitle = __('Companies', true);
	}

	function view() {
		$this->Article = $this->SiteCompany; // что работало все, что написано для Article в самом плагине
		$aArticle = $this->PCArticle->view(str_replace('.html', '', $this->params['id']));
		if (!$aArticle) {
			return $this->redirect('/pages/nonExist');
		}

		$articleID = $aArticle['Article']['id'];

		$this->SiteComment->listForm($articleID);

		$aArticle['Gallery'] = $this->Media->getMedia('Company', $aArticle['Article']['id']);

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
