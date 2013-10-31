<?
	if (isset($aRelatedArticles) && $aRelatedArticles) {
?>
<h2><? __('Related articles');?></h2>
<div>
<?
		foreach($aRelatedArticles as $article) {
			$url = $this->Router->url($article);
?>
	<a href="<?=$url?>"><?=$article['Article']['title']?></a><br />
<?
		}
?>
</div>
<?
	}
?>