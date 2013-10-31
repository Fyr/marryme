<?
class SiteArticle extends Article {
	var $name = 'SiteArticle';
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

	function getMainProduct() {
		return $this->find('first', array('conditions' => array('Article.object_type' => 'products', 'published' => 1), 'order' => 'Article.id DESC'));
	}
	
	function getRelatedObjects($aTags, $object_type, $exceptID, $limit = 5) {
		$sql = 'SELECT * FROM (SELECT Article.id, Article.created, Article.object_type, Article.object_id, Article.title, Article.page_id, COUNT(*) as count 
FROM tag_objects AS TagObject
JOIN articles as Article ON Article.object_type = "'.$object_type.'" AND Article.id = TagObject.object_id
WHERE Article.published AND TagObject.tag_id IN ('.implode(',', $aTags).') AND NOT (TagObject.object_type = "Article" AND TagObject.object_id = '.$exceptID.')
GROUP BY TagObject.object_type, TagObject.object_id
ORDER BY count DESC, Article.created DESC) AS Article ORDER BY RAND()
LIMIT '.$limit;
		$_ret = $this->query($sql);
		return $_ret;
	}

}
