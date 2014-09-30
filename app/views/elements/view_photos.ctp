<?
	/*
	$this->Html->css(array('jquery.fancybox'), null, array('inline' => false));
	$this->Html->script(array('jquery.fancybox'), array('inline' => false));
	$this->Html->css(array('fancybox'), null, array('inline' => false));
	$this->Html->script(array('fancybox'), array('inline' => false));
	*/
	$this->PHCore->css(array('jquery.fancybox'));
	$this->PHCore->js(array('jquery.fancybox'));
	$imgCount = 0;
	foreach($aArticle['Media'] as $media) {
		if ($media['media_type'] == 'image') {
			$imgCount++;
		}
	}
?>
	<div class="new_items">

		<div class="album">
			<span class="count"><?=$imgCount?> фото</span><br />
			<span class="update">Обновлёно: <?=$this->PHTime->niceShort($aArticle['Article']['modified'])?></span>
		</div>

<?
	foreach($aArticle['Media'] as $media) {
		if ($media['media_type'] == 'image') {
?>
		<div class="item">
			<div class="image"><a href="<?=$this->PHMedia->getUrl($media['object_type'], $media['id'], null, $media['file'].$media['ext'])?>" rel="photoalbum"><img src="<?=$this->PHMedia->getUrl($media['object_type'], $media['id'], '113x', $media['file'].$media['ext'])?>" alt="" /></a></div>
		</div>
<?
		}
	}
?>
	</div>
<script type="text/javascript">

$(document).ready(function(){
	$(".new_items .image a").fancybox({
		'padding': 5
	});
});
</script>
