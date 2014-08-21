<?
class BrandProduct extends Article {
	var $name = 'BrandProduct';
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
		)
	);

	var $belongsTo = array(
		'Category' => array(
			'className' => 'category.Category',
			'foreignKey' => 'category_id',
			'dependent' => false
		),
		'Collection' => array(
			'className' => 'article.Article',
			'foreignKey' => 'collection_id',
			'dependent' => false
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
