<?
	foreach($aArticles as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '113x', $featured, $id);
		//$url = '/product/?data[filter][Article.brand_id]='.$id;
?>
						<div class="item">
							<!--div class="image" style="background: none;">
								<a href="<?=$url?>"><img src="<?=$src?>" alt="" style="border: none;" /></a>
							</div-->
							<div class="description">
								<span class="h4"><a href="<?=$url?>"><b><?=$title?></b></a></span>
								<p><?=$teaser?></p>
								<!--p class="more"><a href="<?=$url?>">посмотреть коллекции</a></p-->
							</div>
						</div>
						<div class="new_items">
<?
		
		foreach($aRelatedProducts[$id] as $_article) {
			$this->ArticleVars->init($_article, $_url, $_title, $_teaser, $_src, '160x192');
?>
						
							<div class="item">
								<div class="image">
									<a href="<?=$url?>" title="посмотреть коллекции" rel="photoalbum"><img src="<?=$_src?>" alt="<?=$_title?>" /></a>
								</div>
								<div class="shadow"></div>
								<span class="h4">
									<a href="<?=$url?>" title="посмотреть коллекции"><?=$_title?></a><br/>
								</span>
							</div>
<?
		}
?>
						</div>
						<p class="more"><a href="<?=$url?>">посмотреть коллекции</a></p>
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