<?
	foreach($aArticles as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '113x', $featured, $id);
?>
						<div class="item">
							<!--div class="image" style="background: none;">
								<a href="<?=$url?>"><img src="<?=$src?>" alt="" style="border: none;" /></a>
							</div-->
							<div class="description">
								<span class="h4"><a href="<?=$url?>" title="посмотреть все модели" rel="nofollow"><b><?=$title?></b></a></span>
								<p><noindex><?=$teaser?></noindex></p>
								<!--p class="more"><a href="<?=$url?>">посмотреть коллекции</a></p-->
							</div>
						</div>
						<div class="new_items">
<?
		
		foreach($aRelatedProducts[$id] as $_article) {
			$this->ArticleVars->init($_article, $_url, $_title, $_teaser, $_src, '160x192');
			$alt = ($_article['Category']['id'] == 18) ? 'cвадебное платье '.$_title : 'платье '.$_title;
?>
						
							<div class="item">
								<div class="image">
									<a href="<?=$_url?>" title="посмотреть модель <?=$_title?>" rel="nofollow"><img src="<?=$_src?>" alt="<?=$alt?>" /></a>
								</div>
								<div class="shadow"></div>
								<span class="h4">
									<a href="<?=$_url?>" title="посмотреть модель <?=$_title?>" rel="nofollow"><?=$_title?></a><br/>
								</span>
							</div>
<?
		}
?>
						</div>
						<p class="more more-brands"><a href="<?=$url?>" rel="nofollow">посмотреть все модели</a></p>
						<div class="clear"></div>
<?
	}
	echo $this->element('banner2');
	if (isset($content)) {
?>
				<div>
					<?=$this->element('article_view', array('plugin' => 'articles', 'aArticle' => $content))?>
				</div>
<?
	}
?>