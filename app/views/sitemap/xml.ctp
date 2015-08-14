<? echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?
	$aStatic = array(
		'/',
		'/news/',
		'/articles/',
		'/photo/',
		'/feedback/',
		$this->Router->catUrl('brands', array('id' => 18, 'title' => '-')),
		$this->Router->catUrl('brands', array('id' => 19, 'title' => '-')),
		'/aksessuary-20/subcategories/',
		
		'/svadebnye-salony-minsk/',
		'/pages/show/brides',
		'/pages/show/about-us',
		'/contacts/'
	);
	foreach($aStatic as $url) {
		echo $this->element('xml_url', array('url' => $url));
	}
	foreach($aBrandCollections as $brandID => $aID) {
		foreach($aID as $_id) {
			$url = $this->Router->url($aCatCollections[$_id]);
			echo $this->element('xml_url', array('url' => $url));
		}
	}
	foreach($aAcsCategories as $article) {
		$url = $this->Router->url($article);
		echo $this->element('xml_url', array('url' => $url));
	}
	foreach($aArticles as $article) {
		$url = $this->Router->url($article);
		echo $this->element('xml_url', array('url' => $url));
	}
	foreach($aProducts as $article) {
		$url = $this->Router->url($article);
		echo $this->element('xml_url', array('url' => $url));
	}
?>
</urlset>
