<?=$this->element('article_view', array('plugin' => 'articles'))?>
<?=$this->element('banner2')?>
<?
	if (isset($aRelatedArticles) && $aRelatedArticles) {
?>
<p>
	<br />
	<b>Статьи по данной тематике:</b><br />
<?
		foreach($aRelatedArticles as $article) {
			$url = $this->Router->url($article);
?>
	<a href="<?=$url?>"><?=$article['Article']['title']?></a><br />
<?
		}
?>
</p>
<?
	}
?>
