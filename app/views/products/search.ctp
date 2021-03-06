<?
	$this->PHCore->css(array('jquery.fancybox'));
	$this->PHCore->js(array('jquery.fancybox'));
?>
<?=$this->element('title', array('title' => 'Поиск по каталогу'))?>
<div class="block">
	<div class="new_items">
<?
	$aText = array();
	foreach($aArticles as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '173x');
		$id = $article['Article']['id'];
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
							<span class="h4">
								<a class="small" href="<?=$catUrl?>" title="<?=$category?>"><?=$category?></a><span class="small">:</span> <br/>
								<a href="<?=$url?>" title="<?=$teaser?>"><?=$title?></a><br/>
								<?=$this->element('prices', array('article' => $article))?>
							</span>
						</div>
<?
		}
	}
	foreach($aText as $url => $title) {
?>
		<div style="margin-bottom: 5px;">
			<span class="h4"><a href="<?=$url?>"><?=$title?></a></span>
		</div>
<?
	}
	if (!$aArticles) {
?>

		<br />
		Извините, по данным критериям поиска ничего не найдено.<br />
		<br />
		Вы можете посмотреть наши модели по другим ссылкам:<br />
		<ul>
			<li><a href="<?=$this->Router->catUrl('brands', array('id' => 18, 'title' => '-'))?>">Свадебные платья</a></li>
			<li><a href="<?=$this->Router->catUrl('brands', array('id' => 19, 'title' => '-'))?>">Вечерние платья</a></li>
			<li><a href="/aksessuary-20/subcategories/">Аксессуары</a></li>
<?
		if (SHOW_SEARCH_ACTIVE) {
?>
			<li><a href="/products/activeProducts/">Платья в наличии</a></li>
<?
		}
?>
		</ul>
<?
	}
?>
<?=$this->element('pagination2', array('filterURL' => $aFilters['url']))?>
	</div>
	<div class="clear"></div>
</div>
<?=$this->element('banner2')?>

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

