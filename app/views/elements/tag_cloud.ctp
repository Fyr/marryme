<div id="tags" style="width: <?=TAG_CLOUD_W?>px; height: <?=TAG_CLOUD_H?>px">
<?
	foreach($aTags as $item) {
		$title = $item['TagcloudLink']['title'];
		$url = $item['TagcloudLink']['url'];
		$fontSize = $item['TagcloudLink']['size'];
?>
	<a href="<?=$url?>" style="font-size:<?=$fontSize?>px;"><?=$title?></a>
<?
	}
?>
</div>