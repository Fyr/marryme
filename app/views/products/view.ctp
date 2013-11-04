<?
	$this->ArticleVars->init($aArticle, $url, $title, $teaser, $src, '300x', $featured, $id);
	$media = $aArticle['Media'][0];
	$orig = $orig = $this->PHMedia->getUrl($media['object_type'], $media['id'], 'noresize', $media['file'].$media['ext']);
?>
				<div class="block">
					<h3><span><span><span><?=$title?></span></span></span></h3>
					<div class="item_photo">
						<div class="big">
							<a href="<?=$orig?>" target="_blank" title="Показать оригинал"><img src="<?=$src?>" alt="" /></a>
						</div>

						<div class="thumbs">
							<div>
<?
	for($i = 0; $i < count($aArticle['Media']); $i++) {
		$media = $aArticle['Media'][$i];
		$orig = $this->PHMedia->getUrl($media['object_type'], $media['id'], 'noresize', $media['file'].$media['ext']);
		$thumb = $this->PHMedia->getUrl($media['object_type'], $media['id'], '90x', $media['file'].$media['ext']);
		$big = $this->PHMedia->getUrl($media['object_type'], $media['id'], '300x', $media['file'].$media['ext']);
?>
								<a href="<?=$big?>" rel="<?=$orig?>"><img src="<?=$thumb?>" alt="" /></a>
<?
	}
?>

							</div>
						</div>
					</div>

					<div class="text">
						<ul class="description">
<?
	if ($aArticle['Article']['category_id'] == 20) {
		$url = $this->Router->catUrl(($aArticle['Category']['id'] == 20) ? 'subcategories' : 'brands', $aArticle['Category']);
?>
							<li><strong>Категория:</strong> <a href="<?=$url?>"><?=$aArticle['Category']['title']?></a></li>
							<li><strong>Подкатегория:</strong> <?=$aArticle['Subcategory']['Article']['title']?></li>
<?
	} else {
		$url = $this->Router->catUrl(($aArticle['Category']['id'] == 20) ? 'subcategories' : 'brands', $aArticle['Category']);
?>
							<li><strong>Категория:</strong> <a href="<?=$url?>"><?=$aArticle['Brand']['Category']['title']?></a></li>
							<li><strong>Брэнд:</strong> <?=$aArticle['Brand']['Article']['title']?></li>
							<li><strong>Коллекция:</strong> <?=$aArticle['Collection']['Article']['title']?></li>
<?
	}
?>
							<!--li><strong>В наличии:</strong> <?=($aArticle['Article']['is_active']) ? 'Да' : 'Нет'?></li-->
						</ul>
						<?=$this->element('article_view', array('plugin' => 'articles'))?>
						<div class="atc">
							<p class="price"><!--span class="old price">1020$</span-->
<?
	if (SHOW_PRICE) {
?>
								<?=$this->Price->format(__('Price', true).': ', $aArticle['Article']['price'])?><br/>
								<?=$this->Price->format(__('Price2', true).': ', $aArticle['Article']['price2'])?>
<?
	}
	$item = 'Заказать свадебное платье';
	if ($aArticle['Article']['category_id'] == 19) {
		$item = 'Заказать вечернее платье';
	} elseif ($aArticle['Article']['category_id'] == 20) {
		$item = 'Заказать акксессуар';
	}
?>
							</p>
							<a class="unvisited" href="/"><?=$item?></a>
							<!--
							<a href="#" class="add_to_cart"></a>
							<p><em>(товар уже купили <strong>12</strong> раз)</em></p>
							-->
						</div>
					</div>

				</div>
				<p>
					<b>Смотрите также:</b>
				</p>
<?
	if ($aArticle['Article']['category_id'] <> 20) {
		$this->ArticleVars->init($aArticle['Collection'], $url, $title, $teaser, $src, null);
?>
		<a href="<?=$url?>">Модели <?=($aArticle['Article']['category_id'] == 18) ? 'свадебных' : 'вечерних'?> платьев из коллекции <?=$title?></a><br /><br />
<?
		$this->ArticleVars->init($aArticle['Brand'], $url, $title, $teaser, $src, null);
?>
		<a href="<?=$url?>">Коллекции <?=($aArticle['Article']['category_id'] == 18) ? 'свадебных' : 'вечерних'?> платьев <?=$title?></a><br /><br />
<?
		$url = $this->Router->catUrl(($aArticle['Category']['id'] == 20) ? 'subcategories' : 'brands', $aArticle['Category']);
		$title = $aArticle['Category']['title'];
?>
		<a href="<?=$url?>"><?=$title?> других брендов</a><br />
<?
	} else {
		$url = $this->Router->url($aArticle['Subcategory']);
?>
		<a href="<?=$url?>">Посмотреть аксессуары других моделей</a>
<?
	}
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.unvisited').get(0).href = 'javascript:void(0)';
	$('.unvisited').click(function() {
		window.location.href = "/contacts";
	});
});
</script>