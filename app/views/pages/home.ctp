				<div class="block">
					<?=$this->element('title', array('title' => $content['Article']['title']))?>
					<?=$this->element('article_view', array('plugin' => 'articles', 'aArticle' => $content))?>
				</div>
				<?=$this->element('banner2')?>
				<div class="block">
					<?=$this->element('title2', array('title' => 'Новости'))?>
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
								<span class="h4"><a href="<?=$url?>"><?=$title?></a></span>
								<p><?=$teaser?></p>
								<p class="more"><a href="<?=$url?>">подробнее</a></p>
							</div>
						</div>
<?
		}
?>
					</div>
					<div class="textright">
						<a href="/news/">Посмотреть все новости</a>
					</div>
				</div>

				<div class="block">
					<?=$this->element('title2', array('title' => 'Последние поступления'))?>
					<div class="list_items">
<?
	foreach($aProducts as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '173x');
?>
						<div class="item">
							<div class="image">
								<a href="<?=$url?>" title="<?=$title?>"><img src="<?=$src?>" alt="<?=$title?>" /></a>
							</div>
							<span class="h4"><a href="<?=$url?>"><?=$title?></a></span>
						</div>
<?
	}
?>
					</div>
				</div>
