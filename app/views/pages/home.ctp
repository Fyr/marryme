<style type="text/css">
.list .item {
	background: none;
}
</style>
				<div class="block">
					<h3><span><span><span><?=$content['Article']['title']?></span></span></span></h3>
					<?=$this->element('article_view', array('plugin' => 'articles', 'aArticle' => $content))?>
				</div>
				<div class="block">
					<h3><span><span><span>Новости</span></span></span></h3>
					<div class="list">
<?
		foreach($aNews as $article) {
			$this->ArticleVars->init($article, $url, $title, $teaser, $src, '173x');
?>
						<div class="item">
<?
			if ($src) {
?>
							<div class="image">
								<a href="<?=$url?>"><img src="<?=$src?>" alt="<?=$title?>" /></a>
							</div>
<?
			}
?>
							<div class="description">
								<h4><a href="<?=$url?>"><?=$title?></a></h4>
								<p><?=$teaser?></p>
								<p class="more"><a href="<?=$url?>">подробнее</a></p>
							</div>
						</div>
<?
		}
?>
					</div>
					<div align="right">
						<a href="/news/">Посмотреть все новости</a>
					</div>
				</div>

				<div class="block">
					<h3><span><span><span>Последние поступления</span></span></span></h3>
					<div class="list_items">
<?
	foreach($aProducts as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '173x');
?>
						<div class="item">
							<div class="image">
								<a href="<?=$url?>" title="<?=$title?>"><img src="<?=$src?>" alt="<?=$title?>" /></a>
							</div>
							<h4><a href="<?=$url?>"><?=$title?></a></h4>
						</div>
<?
	}
?>
					</div>
				</div>
