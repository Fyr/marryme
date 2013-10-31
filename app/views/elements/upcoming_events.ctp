<?
	if ($upcomingEvent) {
		$this->ArticleVars->init($upcomingEvent, $url, $title, $teaser, $src, '100x');
		$class = ($src) ? '' : 'noImage';
?>
							<span class="<?=$class?>">
								<h3><?=$title?></h3>
<?
		if ($src) {
?>
								<div class="image">
									<a href="#">
										<img src="<?=$src?>" alt="<?=$title?>" />
											<span class="light"></span>
									</a>
									<div class="shadow"></div>
								</div>
<?
		}
?>
								<div class="text">
									<p><?=$teaser?></p>
									<a href="<?=$url?>" class="more">подробнее</a>
								</div>
							</span>
<?
	}
?>