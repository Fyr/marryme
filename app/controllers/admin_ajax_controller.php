<?
class AdminAjaxController extends AppController {
	var $name = 'AdminAjax';
	var $layout = 'empty';
	// var $components = array('articles.PCArticle');
	
	var $uses = array('articles.Article', 'comments.Comment'); // , 'categories.PMCategory');

	function categoriesUpdate() {
		// file_put_contents('tmp_cu.log', print_r($_GET, true));
		echo 'OK';
		exit();
	}
	
	function categoriesDelete() {
		// file_put_contents('tmp_cd.log', print_r($_GET, true));
		echo 'OK';
		exit();
	}
	
	function setFlag($fieldName, $id, $flag) {
		list($model, $fieldName) = explode('.', $fieldName);
		$this->$model->save(array('id' => $id, $fieldName => $flag));
		exit();
	}
}