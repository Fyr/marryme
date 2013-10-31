<?
	$this->PHCore->css(array('jquery.fancybox'));
	$this->PHCore->js(array('jquery.fancybox'));
	$url = $this->Router->catUrl(($aArticle['Category']['id'] == 20) ? 'subcategories' : 'brands', $aArticle['Category']);
?>
<h3><span><span><span><?=$aArticle['Article']['title']?></span></span></span></h3>
<div class="block">
	<div class="list">
		<div class="item">
			<ul class="description">
				<li><strong>Категория:</strong> <a href="<?=$url?>"><?=$aArticle['Category']['title']?></a> </li>
			</ul>
			<?=$this->element('article_view', array('plugin' => 'articles'))?>
		</div>
	</div>
	<h3><span><span><span>Аксессуары: <?=$aArticle['Article']['title']?></span></span></span></h3>
	<div class="new_items">
<?
	$aText = array();
	foreach($aArticles as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '173x');
		$id = $article['Article']['id'];
		$media = $article['Media'][0];
		$src_orig = $this->PHMedia->getUrl($media['object_type'], $media['id'], null, $media['file'].$media['ext']);

		if (!$src) {
			$aText[$url] = $title;
		} else {
?>
						<div class="item">
							<div class="image">
								<div id="link<?=$id?>" class="hide">
									<a href="<?=$url?>">Посмотреть аксессуар "<?=$title?>"</a>
								</div>
								<a id="image<?=$id?>" href="<?=$src_orig?>" title="Увеличить фото" rel="photoalbum"><img src="<?=$src?>" /></a>
<?
			if ($featured) {
?>
								<span class="sticker new"></span>
<?
			} elseif ($article['Article']['is_active']) {
?>
								<span class="sticker active"></span>
<?
			}
?>
							</div>
							<h4><a class="small" href="<?=$url?>" title="<?=$teaser?>"><?=$title?></a><br />
<?
			if (SHOW_PRICE) {
?>
								<span class="small prices"><?=$this->Price->format('', $article['Article']['price'])?></span>
<?
			}
?>
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

