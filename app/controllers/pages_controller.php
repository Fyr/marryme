<?
class PagesController extends SiteController {
	var $name = 'Pages';
	var $helpers = array('articles.HtmlArticle');
	var $uses = array('articles.Article', 'SiteArticle');

	function home() {
		if ((isset($this->params['url']['url']) && $this->params['url']['url'] != '/') || $_SERVER['REQUEST_URI'] == '/index.php') {
			return $this->redirect('/');
		}
		// $this->aBreadCrumbs = array('' => 'Главная');
		$aArticle = $this->Article->find('first', array('conditions' => array('Article.page_id' => 'homepage')));
		$this->set('content', $aArticle);

		// Последние новости
		$aNews = $this->Article->find('all', array(
			'conditions' => array('Article.object_type' => 'news', 'Article.published' => 1),
			'order' => 'Article.created DESC',
			'limit' => 5
		));
		$this->set('aNews', $aNews);

		$aProducts = $this->Article->find('all', array(
			'conditions' => array('Article.object_type' => 'products', 'published' => 1),
			'order' => 'Article.created DESC',
			'limit' => 3
		));
		$this->set('aProducts', $aProducts);
		
		$this->pageTitle = (isset($aArticle['Seo']['title']) && $aArticle['Seo']['title']) ? $aArticle['Seo']['title'] : $aArticle['Article']['title'];
		$this->data['SEO'] = $aArticle['Seo'];
	}

	function show($pageID) {
		$pageID = str_replace('.html', '', $pageID);
		$aArticle = $this->Article->findByPage_id($pageID);

		if (!$aArticle) {
			$this->redirect('/pages/nonExist');
		}

		$this->set('aArticle', $aArticle);
		$this->currMenu = $pageID;
		$this->aBreadCrumbs = array('/' => 'Главная', $aArticle['Article']['title']);
		$this->pageTitle = (isset($aArticle['Seo']['title']) && $aArticle['Seo']['title']) ? $aArticle['Seo']['title'] : $aArticle['Article']['title'];
		$this->data['SEO'] = $aArticle['Seo'];
	}
/*
	function faqList() {
		$this->aBreadCrumbs = array('/' => 'Главная', 'Вопросы и Ответы');

		$this->loadModel('faqs.Faq');
		$aFaq = $this->Faq->find('all');
		$this->set('aFaq', $aFaq);
	}

	function faq($faq_id) {
		$this->loadModel('faqs.Faq');
		$this->loadModel('faqs.FaqQA');

		$aFaq = $this->Faq->findById($faq_id);
		$aFaqQA = $this->FaqQA->getFaq($faq_id);
		$this->aBreadCrumbs = array('/' => 'Главная', '/pages/faqList' => 'Вопросы и Ответы', $aFaq['Faq']['title']);

		$this->set('aFaq', $aFaq);
		$this->set('aFaqQA', $aFaqQA);
	}

*/
	function inprogress() {
	}

	function nonExist() {
		$this->layout = 'error';
	}
}
