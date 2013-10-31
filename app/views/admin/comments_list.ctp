<h2><?__('Comments');?></h2>
<?
	$aActions = array(
	/*
		'table' => array(
			$this->element('icon_add', array('plugin' => 'core', 'href' => '/admin/articlesEdit/Article.object_type:'.$objectType)),
			array('grid_table_showfilter', array('plugin' => 'grid'))
		),
		*/
		'row' => array(
			array('grid_row_edit', array('plugin' => 'grid')),
			array('grid_row_del', array('plugin' => 'grid')),
			array('comment_rowaction_preview')
		),
		'checked' => array(
			array('grid_checked_del', array('plugin' => 'grid')),
		)

	);
	$aRender = array(
		'fields' => array(
			'Comment.object_id' => array('comments_list_object_id'),
			'Comment.published' => array('comments_list_published')
		)
	);
?>
<?=$this->PHGrid->render('SiteComment', $aActions, $aRender)?>
