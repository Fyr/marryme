<?
	$this->PHCore->css(array('jquery.fancybox'));
	$this->PHCore->js(array('jquery.fancybox'));

	$url = $this->Router->catUrl(($aArticle['Category']['id'] == 20) ? 'subcategories' : 'brands', $aArticle['Category']);
?>
<div class="block">
			<ul class="description">
				<li><strong>Категория:</strong> <a href="<?=$url?>"><?=$aBrand['Category']['title']?></a> </li>
				<li><strong>Брэнд:</strong> <?=$aBrand['Article']['title']?></li>
			</ul>
			<?=$this->element('article_view', array('plugin' => 'articles'))?>
<?
/*
	if ($aAnotherCollections) {
?>
			<ul class="description">
				<li>
					<strong>Другие коллекции этого брэнда:</strong><br />
<?
		foreach($aAnotherCollections as $article) {
			$this->ArticleVars->init($article, $url, $title, $teaser, $src, '151x', $featured);
?>
					<a href="<?=$url?>"><?=$title?></a><br />
<?
		}
?>
				</li>
			</ul>
<?
	}
	*/
?>
</div>
<?=$this->element('banner2')?>
<div class="block">
			<?=$this->element('title', array('title' => 'Модели коллекции '.$aArticle['Article']['title']))?>
			<!--div align="center" style="margin-bottom: 20px">
				<a href="javascript:void(0)" onclick="gallery_onClick()">Посмотреть галерею</a>
			</div-->
					<div class="new_items">
<?
		foreach($aProducts as $article) {
			$this->ArticleVars->init($article, $url, $title, $teaser, $src, '151x', $featured);
			$id = $article['Article']['id'];
			$media = $article['Media'][0];
			$src_orig = $this->PHMedia->getUrl($media['object_type'], $media['id'], null, $media['file'].$media['ext']);
?>
						<div class="item">
							<div class="image">
								<div id="link<?=$id?>" class="hide">
									<a href="<?=$url?>">Посмотреть модель <?=$title?></a>
								</div>
								<a id="image<?=$id?>" href="<?=$src_orig?>" title="Увеличить фото" rel="photoalbum"><img src="<?=$src?>" /></a>
								<?=$this->element('sticker', array('article' => $article))?>
							</div>
							<h4>
								<a href="<?=$url?>" title="<?=$teaser?>"><?=$title?></a><br/>
								<?=$this->element('prices', array('article' => $article))?>
							</h4>
						</div>
<?
		}
?>
					</div>
</div>
<?
	if ($aAnotherCollections) {
?>
	<div class="block">
			<?=$this->element('title', array('title' => 'Другие коллекции '.$aBrand['Article']['title']))?>
<?
		foreach($aAnotherCollections as $article) {
			$this->ArticleVars->init($article, $url, $title, $teaser, $src, '151x', $featured);
?>
					<h4><a href="<?=$url?>"><?=$title?></a></h4><br />
<?
		}
?>
	</div>
<?
	}
?>
</div>
<script type="text/javascript">
function gallery_onClick() {
	//$('.new_items .image a').eq(0).trigger('click');
}

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

