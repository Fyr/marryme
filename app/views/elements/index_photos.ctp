<?
	$this->Html->css('photos', null, array('inline' => false));
?>
<div class="photos">
<?
	foreach ($aArticles as $article) {
		$url = $this->Router->url($article);
?>
	<div class="album">
<?
		$media = $article['Media'][0];
?>
		<div class="image_back">
			<div class="sides_frame"><a style="background-image: url('<?=$this->PHMedia->getUrl($media['object_type'], $media['id'], THUMB_X.'x', $media['file'].$media['ext'])?>');" href="<?=$url?>"></a></div>
			<div class="bottom_frame"></div>
		</div>
		<h2><a href="<?=$url?>"><?=$article['Article']['title']?></a></h2>
<?
		$updated = ($article['Article']['modified']) ? $article['Article']['modified'] : $article['Article']['created'];
?>
		<span class="count"><?=$article['Stat']['photos']?> фото</span><br>
		<span class="update">Обновлён <?=$this->PHTime->niceShort($updated)?></span>
	</div>
<?
	}
?>
</div>
