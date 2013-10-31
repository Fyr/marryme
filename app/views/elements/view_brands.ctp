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
	<h3><span><span><span>Коллекции <?=$aArticle['Article']['title']?></span></span></span></h3>
	<div class="list_items">
<?
	$aText = array();
	foreach($aCollections as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '173x');
		if (!$src) {
			$aText[$url] = $title;
		} else {
?>
						<div class="item">
							<div class="image">
								<a href="<?=$url?>" title="<?=$title?>"><img src="<?=$src?>" alt="<?=$title?>" /></a>
							</div>
							<h4><a href="<?=$url?>"><?=$title?></a></h4>
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

