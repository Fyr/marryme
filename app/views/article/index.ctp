				<div class="block">
					<h3><span><span><span><?=$page_title?></span></span></span></h3>
					<div class="list">
<?
	if ($objectType == 'brands') {
		echo $this->element('article_index_brands');
	} else {
		foreach($aArticles as $article) {
			$this->ArticleVars->init($article, $url, $title, $teaser, $src, '173x');
?>
						<div class="item">
<?
			if ($src) {
?>
							<div class="image">
								<a href="<?=$url?>"><img src="<?=$src?>" alt="<?=$title?>" /></a>
								<!--span class="sticker new"></span-->
							</div>
<?
			}
?>
							<div class="description">
								<h4><a href="<?=$url?>"><?=$title?></a></h4>
								<!--p class="category">Категория: <a href="">Свадебные платья</a></p-->
								<p><?=$teaser?></p>
								<p class="more"><a href="<?=$url?>">подробнее</a></p>
							</div>
						</div>
<?
		}
	}
?>
<?=$this->element('pagination', array('objectType' => $objectType))?>
					</div>
				</div>
