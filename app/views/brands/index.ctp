				<div class="block">
					<?=$this->element('title', array('title' => $aCategory['Category']['title']))?>
					<div class="list">
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
								<h4><a href="<?=$url?>"><?=$title?></a></h4>
								<p><?=$teaser?></p>
								<p class="more"><a href="<?=$url?>">посмотреть модели</a></p>
							</div>
						</div>
<?
	}
?>
					</div>
				</div>
<?=$this->element('banner2')?>