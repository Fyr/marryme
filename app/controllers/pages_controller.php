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
		/*
		if (strpos($pageID, '.html') !== false) {
			return $this->redirect(array('action' => 'show', str_replace('.html', '', $pageID)));
		}
		*/
		$aArticle = $this->Article->findByPage_id($pageID);

		if (!$aArticle) {
			return $this->redirect('/pages/nonExist');
		}

		$this->set('aArticle', $aArticle);
		$this->currMenu = $pageID;
		$this->aBreadCrumbs = array('/' => 'Главная', $aArticle['Article']['title']);
		$this->pageTitle = (isset($aArticle['Seo']['title']) && $aArticle['Seo']['title']) ? $aArticle['Seo']['title'] : $aArticle['Article']['title'];
		$this->data['SEO'] = $aArticle['Seo'];
	}

	function inprogress() {
	}

	function nonExist() {
		header("HTTP/1.0 404 Not Found");
		$this->layout = 'error';
	}
}
