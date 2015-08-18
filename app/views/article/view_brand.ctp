<?
	$this->PHCore->css(array('jquery.fancybox'));
	$this->PHCore->js(array('jquery.fancybox'));
?>
<div class="block">
<?
	foreach($aCollectionProducts as $collection_id => $aProducts) {
		$collection = $aProducts[0];
		echo $this->element('title', array('title' => $aArticle['Article']['title'].': Модели коллекции '.$collection['Collection']['title']));
?>
					<div class="new_items">
<?
		foreach($aProducts as $article) {
			$this->ArticleVars->init($article, $url, $title, $teaser, $src, '160x192', $featured);
			$id = $article['Article']['id'];
			$media = $article['Media'][0];
			$src_orig = $this->PHMedia->getUrl($media['object_type'], $media['id'], null, $media['file'].$media['ext'].'.png');
?>
						<div class="item">
							<div class="image">
								<div id="link<?=$id?>" class="hide">
									<a href="<?=$url?>">Посмотреть модель <?=$title?></a>
								</div>
								<a id="image<?=$id?>" href="<?=$src_orig?>" title="Увеличить фото" rel="photoalbum"><img src="<?=$src?>" alt="<?=$title?>" /></a>
								<?=$this->element('sticker', array('article' => $article))?>
							</div>
							<div class="shadow"></div>
							<span class="h4">
								<a href="<?=$url?>" title="<?=$teaser?>"><?=$title?></a><br/>
								<?=$this->element('prices', array('article' => $article))?>
							</span>
						</div>
<?
		}
?>
					</div>
					<div class="clear"></div>
<?
	}
?>
<?=$this->element('pagination', array('objectType' => $objectType))?>
</div>
<?
	$url = $this->Router->catUrl(($aArticle['Category']['id'] == 20) ? 'subcategories' : 'brands', $aArticle['Category']);
?>
<?=$this->element('banner2')?>
<?=$this->element('title', array('title' => $page_title))?>
<div class="block">
	<div class="list">
		<div class="item">
			<ul class="description">
				<li><strong>Категория:</strong> <a href="<?=$url?>"><?=$aArticle['Category']['title']?></a> </li>
			</ul>
			<?=$this->element('show_article')?>
			<?//$this->element('article_view', array('plugin' => 'articles'))?>
		</div>
	</div>
</div>

<div class="block">
<?
	foreach($aCollectionProducts as $collection_id => $aProducts) {
		$collection = $aProducts[0];
		echo $this->element('title', array('title' => 'Коллекция '.$collection['Collection']['title']));
		// echo $this->HtmlArticle->fulltext($collection['Collection']['body']);
		echo $this->element('show_article', array('body' => $collection['Collection']['body']));
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



