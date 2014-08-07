<div id="tags-not-shown" style="width: <?=TAG_CLOUD_W?>px; height: <?=TAG_CLOUD_H?>px; position: absolute;">
<?
	foreach($aTags as $item) {
		$title = str_replace('&', '&amp;', $item['TagcloudLink']['title']);
		$url = $item['TagcloudLink']['url'];
		$fontSize = $item['TagcloudLink']['size'];
?>
	<a href="<?=$url?>" style="font-size:<?=$fontSize?>px;"><?=$title?></a>
<?
	}
?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#tags-not-shown').css('left', '-9999px');
});
</script>