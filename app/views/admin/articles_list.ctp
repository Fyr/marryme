<h2><?=$pageTitle?></h2>
<?
	if ($objectType == 'pages') {
		$aActions = array(
			'table' => array(
				$this->element('icon_add', array('plugin' => 'core', 'href' => '/admin/articlesEdit/Article.object_type:'.$objectType)),
				array('grid_table_showfilter', array('plugin' => 'grid'))
			),
			'row' => array(
				$this->element('icon_edit', array('plugin' => 'core', 'href' => '/admin/articlesEdit/{$id}'))
			),
			'checked' => array()
		);
	} else {
		$aActions = array(
			'table' => array(
				$this->element('icon_add', array('plugin' => 'core', 'href' => '/admin/articlesEdit/Article.object_type:'.$objectType)),
				array('grid_table_showfilter', array('plugin' => 'grid'))
			),
			'row' => array(
				$this->element('icon_edit', array('plugin' => 'core', 'href' => '/admin/articlesEdit/{$id}')),
				array('grid_row_del', array('plugin' => 'grid')),
				array('article_rowaction_preview', array('plugin' => 'articles'))
			)
		);
	}
	/*
	$aActions = array(
			'table' => array(
				$this->element('icon_add', array('plugin' => 'core', 'href' => '/admin/articlesEdit/Article.object_type:'.$objectType)),
				array('grid_table_showfilter', array('plugin' => 'grid'))
			),
			'row' => array(
				$this->element('icon_edit', array('plugin' => 'core', 'href' => '/admin/articlesEdit/{$id}')),
				array('grid_row_del', array('plugin' => 'grid')),
				array('article_rowaction_preview', array('plugin' => 'articles'))
			)
		);
		*/
	$aRender = null;
	if ($objectType == 'collections') {
		$aRender = array(
			'fields' => array(
				'Category.title' => array('collection_renderfield_category')
			)
		);
	} elseif ($objectType == 'products') {
		$aRender = array(
			'fields' => array(
				'Article.object_type' => array('product_renderfield_object_type'),
				'Article.object_id' => array('product_renderfield_object_id'),
				'Article.images_filesize' => array('product_renderfield_images_filesize')
			)
		);
	}


?>
<?=$this->PHGrid->render('SiteArticle', $aActions, $aRender)?>