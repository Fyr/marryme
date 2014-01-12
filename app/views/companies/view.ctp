<?
	$this->PHCore->css(array('jquery.fancybox'));
	$this->PHCore->js(array('jquery.fancybox'));
	$company = $aArticle['Company']
?>
<div class="block">
	<?=$this->element('title', array('title' => $aArticle['Article']['title']))?>
	<ul class="description">
<?
	if ($company['address']) {
?>
		<li><strong><?__('Address');?>:</strong><br/><?=nl2br($company['address'])?></li>
<?
	}
	if ($company['phones']) {
?>
		<li><strong><?__('Phones');?>:</strong><br/><?=nl2br($company['phones'])?></li>
<?
	}
	if ($company['work_time']) {
?>
		<li><strong><?__('Work time');?>:</strong><br/><?=nl2br($company['work_time'])?></li>
<?
	}
	if ($company['site_url']) {
?>
		<li><strong><?__('Site');?>:</strong> <a href="http://<?=$company['site_url']?>" target="_blank"><?=$company['site_url']?></a> </li>
<?
	}
	if ($company['email']) {
?>
		<li><strong><?__('Email');?>:</strong> <a href="mailto:<?=$company['email']?>"><?=$company['email']?></a> </li>
<?
	}
?>
	</ul>
	<?=$this->element('article_view', array('plugin' => 'articles'))?>
</div>
<?
	if ($aArticle['Media']) {
?>
<div class="block">
					<div class="new_items">
<?
		foreach($aArticle['Media'] as $media) {
			$src = $this->PHMedia->getUrl($media['object_type'], $media['id'], '113x', $media['file'].$media['ext']);
			$src_orig = $this->PHMedia->getUrl($media['object_type'], $media['id'], null, $media['file'].$media['ext']);
?>
						<div class="item">
							<div class="image">
								<a href="<?=$src_orig?>" title="Увеличить фото" rel="photoalbum"><img src="<?=$src?>" /></a>
							</div>
						</div>
<?
		}
?>
					</div>
</div>
<?
	}
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.new_items .image a').fancybox({
		padding: 5,
	});
});
</script>

