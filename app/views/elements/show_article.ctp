<?
	if (!isset($body)) {
		$body = $aArticle['Article']['body'];
	}
	
	if (mb_strlen($body, 'UTF-8') < 100) {
		echo $this->HtmlArticle->fulltext($body);
	} else {
?>
<div class="articleShow">
	<div class="article-show collapsed">
			<?=$this->HtmlArticle->fulltext($body)?>
	</div>
	<p class="more">
		<span class="expand">...</span>
		<a class="expand" href="javascript:void(0)">развернуть</a>
		<a class="collapse" href="javascript:void(0)">свернуть</a>
	</p>
</div>
<?
	}
?>