<h2><? __('Manage companies');?></h2>
<?
	$aActions = array(
		'table' => array(
			$this->element('icon_add', array('plugin' => 'core', 'href' => '/admin/companiesEdit/')),
			array('grid_table_showfilter', array('plugin' => 'grid'))
		),
		'row' => array(
			// array('company_rowaction_edit'),
			$this->element('icon_edit', array('plugin' => 'core', 'href' => '/admin/companiesEdit/{$id}')),
			array('grid_row_del', array('plugin' => 'grid')),
			// array('article_rowaction_preview', array('plugin' => 'articles'))
		)
	);
	/*
	$aRender = array(
		'fields' => array(
			'Article.title' => array('company_renderfield_site_url', array('plugin' => 'articles'))
		)
	);
	*/
?>
<?=$this->element('grid_render', array('plugin' => 'grid', 'model' => 'SiteCompany', 'actions' => $aActions)) // ?>