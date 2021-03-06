<?
class SitemapController extends SiteController {
	var $name = 'Sitemap';
	var $uses = array('articles.Article', 'SiteArticle', 'SiteProduct', 'category.Category');
	// var $helpers = array('Router', 'ArticleVars');
	
	function index() {
		$this->pageTitle = 'Карта сайта';
		
		// $aMainCategories = $this->Category->findAllByObjectType('brands');
		$aBrands = $this->Article->findAllByObjectType('brands');
		$this->set('aBrands', $aBrands);
		
		$aCollections = $this->Article->findAllByObjectType('collections');
		$this->set('aCollections',  $aCollections);
		
		$aSubcategories = $this->Article->findAllByObjectType('subcategories');
		$this->set('aSubcategories', $aSubcategories);
	}
	
	function xml() {
		header("Content-Type: text/xml");
		$this->layout = 'empty';
		$aArticles = $this->SiteProduct->find('all', array(
			'fields' => array('Category.id', 'Category.title', 'Category.object_id', 'Article.id', 'Article.object_type', 'Article.object_id', 'Article.title', 'Article.page_id'),
			'conditions' => array('Article.object_type' => array('brands', 'articles', 'news', 'companies'), 'Article.published' => 1),
			'order' => array('Article.object_type', 'Article.modified')
		));
		$this->set('aArticles', $aArticles);
		
		$this->Article = $this->SiteArticle;
		$aProducts = $this->Article->find('all', array(
			'fields' => array('Category.id', 'Category.title', 'Category.object_id', 'Article.id', 'Article.object_type', 'Article.object_id', 'Article.title', 'Article.page_id'),
			'conditions' => array('Article.object_type' => 'products', 'Article.published' => 1),
			'order' => array('Article.object_type', 'Article.category_id'),
		));
		$this->set('aProducts', $aProducts);
		
		$this->_initSBCategories();
		$this->set('aAcsCategories', $this->Article->find('all', array('conditions' => array('Article.object_type' => 'subcategories', 'Article.published' => 1))));
	}
}
