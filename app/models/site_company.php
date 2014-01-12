<?
class SiteCompany extends Article {
	var $name = 'SiteCompany';
	var $alias = 'Article';

	var $hasOne = array(
		'Stat' => array(
			'className' => 'stat.Stat',
			'foreignKey' => 'object_id',
			'conditions' => array('Stat.object_type' => 'Article'),
			'dependent' => true
		),
		'Seo' => array(
			'className' => 'seo.Seo',
			'foreignKey' => 'object_id',
			'conditions' => array('Seo.object_type' => 'Article'),
			'dependent' => true
		),
		/*
		'Company' => array(
			'foreignKey' => 'article_id',
			'conditions' => array('Article.object_type' => 'companies'),
			'dependent' => true
		)*/
	);

	var $belongsTo = array(
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'object_id',
			'conditions' => array('Article.object_type' => 'companies'),
			'dependent' => true
		)
	);

	var $hasMany = array(
		'Media' => array(
			'foreignKey' => 'object_id',
			'conditions' => array('Media.object_type' => 'Article', 'Media.media_type' => 'image', 'Media.main' => 1),
			'dependent' => true,
			'order' => array('Media.main DESC', 'media_type')
		)
	);

}
