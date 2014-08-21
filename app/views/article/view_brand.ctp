<?=$this->element('title', array('title' => $page_title))?>
<?
	$url = $this->Router->catUrl(($aArticle['Category']['id'] == 20) ? 'subcategories' : 'brands', $aArticle['Category']);
?>
<div class="block">
	<div class="list">
		<div class="item">
			<ul class="description">
				<li><strong>Категория:</strong> <a href="<?=$url?>"><?=$aArticle['Category']['title']?></a> </li>
			</ul>
			<?=$this->element('article_view', array('plugin' => 'articles'))?>
		</div>
	</div>
	<?=$this->element('banner2')?>
</div>

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
					<?=$this->HtmlArticle->fulltext($collection['Collection']['body'])?>
					<br />
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
<?
	}
?>
<?=$this->element('pagination', array('objectType' => $objectType))?>
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



