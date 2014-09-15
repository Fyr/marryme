<?
	$this->PHCore->css(array('jquery.fancybox'));
	$this->PHCore->js(array('jquery.fancybox'));
?>
<?=$this->element('title', array('title' => $aArticle['Article']['title']))?>
<div class="block">
	<div class="list">
		<div class="item">
			<?=$this->element('article_view', array('plugin' => 'articles'))?>
		</div>
	</div>
	<?=$this->element('banner2')?>
	<?=$this->element('title', array('title' => 'Платья в наличии'))?>
	<div class="new_items">
<?
	$aText = array();
	foreach($aArticles as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '173x', $featured, $id);
		// $id = $article['Article']['id'];
		$category = $article['Category']['title'];
		$catUrl = $this->Router->catUrl('brands', $article['Category']);
		$media = $article['Media'][0];
		$src_orig = $this->PHMedia->getUrl($media['object_type'], $media['id'], null, $media['file'].$media['ext']);

		if (!$src) {
			$aText[$url] = $title;
		} else {
?>
						<div class="item">
							<div class="image">
								<div id="link<?=$id?>" class="hide">
									<a href="<?=$url?>">Посмотреть модель &laquo;<?=$title?>&raquo; из категории &laquo;<?=$category?>&raquo;</a>
								</div>
								<a id="image<?=$id?>" href="<?=$src_orig?>" title="Увеличить фото" rel="photoalbum"><img src="<?=$src?>" /></a>
								<?=$this->element('sticker', array('article' => $article))?>
							</div>
							<div class="shadow"></div>
							<h4>
								<a class="small" href="<?=$catUrl?>" title="<?=$category?>"><?=$category?></a><span class="small">:</span> <br/>
								<a href="<?=$url?>" title="<?=$teaser?>"><?=$title?></a><br/>
								<?=$this->element('prices', array('article' => $article))?>
							</h4>
						</div>
<?
		}
	}
	foreach($aText as $url => $title) {
?>
		<div style="margin-bottom: 5px;">
			<h4><a href="<?=$url?>"><?=$title?></a></h4>
		</div>
<?
	}
?>
	</div>
	<div class="clear"></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.new_items .image a').fancybox({
		padding: 5,
		beforeLoad: function() {
			var id = $(this.element).get(0).id.replace(/image/, '');
			this.title = $('#link' + id).html();
        },
		beforeShow: function () {
			$.fancybox.wrap.bind("contextmenu", function (e) {
				return false;
			});
		}
	});

});
</script>

