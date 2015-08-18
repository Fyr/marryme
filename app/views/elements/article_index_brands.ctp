<?
	foreach($aArticles as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '113x', $featured, $id);
		//$url = '/product/?data[filter][Article.brand_id]='.$id;
?>
						<div class="item">
							<div class="image" style="background: none;">
								<a href="<?=$url?>"><img src="<?=$src?>" alt="" style="border: none;" /></a>
							</div>
							<div class="description">
								<span class="h4"><a href="<?=$url?>"><?=$title?></a></span>
								<p><?=$teaser?></p>
								<p class="more"><a href="<?=$url?>">посмотреть коллекции</a></p>
							</div>
						</div>
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