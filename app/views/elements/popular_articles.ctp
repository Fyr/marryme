<ul class="categories">
<?
	foreach($aPopularArticles as $article) {
		$url = $this->Router->url($article);
		$title = $article['Article']['title'];
?>
	<li>
<?
		if (isset($article['Media'][0])) {
			$media = $article['Media'][0];
			$src = $this->PHMedia->getUrl('article', $media['id'], '55x', $media['file'].$media['ext'])
?>
		<a href="<?=$url?>">
			<img src="<?=$src?>" alt="<?=$title?>" />
		</a>
<?
		}
?>
		<a href="<?=$url?>"><?=$title?></a>
	</li>

<?
	}
?>
</ul>