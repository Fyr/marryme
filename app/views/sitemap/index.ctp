<style type="text/css">
.sitemap-links .section {
	font-size: 1.5em;
	display: block;
	margin: 10px 0 5px 0;
}
.sitemap-links .sub, .sitemap-links .sub2, .sitemap-links .sub3 {
	display: block;
}
.sitemap-links .sub {
	font-size: 1.3em;
	margin: 10px 0 5px 20px;
}
.sitemap-links .sub2 {
	margin: 7px 0 3px 40px;
	font-weight: bold;
}
.sitemap-links .sub3 {
	margin-left: 60px;
}
</style>

<div class="block sitemap-links">
	<?=$this->element('title', array('title' => 'Карта сайта'))?>
	
	<a class="section" href="/"><?=$homePage['title']?></a>
	
	<a class="section" href="<?=$aMenu['products']['href']?>"><?=$aMenu['products']['title']?></a>
<?
		foreach($aMainCategories as $category) {
			$cat_id = $category['Category']['id'];
			$url = $this->Router->catUrl(($cat_id == 20) ? 'subcategories' : 'brands', $category['Category']);
?>
	<a class="sub" href="<?=$url?>"><?=$category['Category']['title']?></a>
<?
			foreach($aBrands as $brand) {
				if ($brand['Article']['object_id'] == $cat_id) {
					$url = $this->Router->url($brand);
?>
	<a class="sub2" href="<?=$url?>"><?=$brand['Article']['title']?></a>
<?
					foreach($aCollections as $collection) {
						if ($collection['Article']['object_id'] == $brand['Article']['id']) {
							$url = $this->Router->url($collection);
?>
	<a class="sub3" href="<?=$url?>"><?=$collection['Article']['title']?></a>
<?
						}
					}
				}
			}
		}
		foreach($aSubcategories as $subcat) {
			$url = $this->Router->url($subcat);
?>
	<a class="sub2" href="<?=$url?>"><?=$subcat['Article']['title']?></a>
<?
		}
?>
	
	<a class="section" href="<?=$aMenu['news']['href']?>"><?=$aMenu['news']['title']?></a>
	<a class="section" href="<?=$aMenu['feedback']['href']?>"><?=$aMenu['feedback']['title']?></a>
	<a class="section" href="<?=$aMenu['photos']['href']?>"><?=$aMenu['photos']['title']?></a>
	<a class="section" href="<?=$aMenu['articles']['href']?>"><?=$aMenu['articles']['title']?></a>
	<a class="section" href="<?=$aMenu['brides']['href']?>"><?=$aMenu['brides']['title']?></a>
	<a class="section" href="<?=$aMenu['about-us']['href']?>"><?=$aMenu['about-us']['title']?></a>
	<a class="section" href="<?=$aMenu['contacts']['href']?>"><?=$aMenu['contacts']['title']?></a>
</div>