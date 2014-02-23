<?
	$this->PHCore->css(array('jquery.fancybox'));
	$this->PHCore->js(array('jquery.fancybox'));
	$company = $aArticle['Company'];
	$this->ArticleVars->init($aArticle, $url, $title, $teaser, $src, '200x');
?>
<div class="block">
	<?=$this->element('title', array('title' => $title))?>
	<ul class="description">
		<img src="<?=$src?>" alt="<?=$title?>" style="float: right; margin: 0 0 10px 10px" />
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
	<div class="clear"></div>
</div>
<div class="block">
	<?=$this->element('article_view', array('plugin' => 'articles'))?>
</div>
<?=$this->element('banner2')?>
<?
	if ($aArticle['Gallery']) {
?>
<div class="block">
					<div class="new_items">
<?
		foreach($aArticle['Gallery'] as $media) {
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

