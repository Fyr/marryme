	<ul class="categories">
<?
	if ($objectType == 'photos') {
		foreach($aCategories as $article) {
			$url = $this->Router->url($article);
			$title = $article['Article']['title'];
?>
		<li>
			<a href="<?=$url?>"><?=$title?></a>
		</li>
<?
		}
	} elseif ($objectType == 'news') {
		foreach($aCategories as $region_id => $title) {
			$url = $this->Router->catUrl('news', array('id' => $region_id, 'title' => $title));
?>
		<li>
			<a href="<?=$url?>"><?=$title?></a>
		</li>
<?
		}
	} else {
		foreach($aCategories as $category) {
			$url = $this->Router->catUrl($objectType, $category['Category']);
			$title = $category['Category']['title'];
?>
		<li>
			<a href="<?=$url?>"><?=$title?></a>
		</li>
<?
		}
	}
?>
	</ul>