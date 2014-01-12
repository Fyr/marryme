				<div class="block">
					<?=$this->element('title', array('title' => __('Companies', true)))?>
					<div class="list">
<?
		foreach($aArticles as $article) {
			$this->ArticleVars->init($article, $url, $title, $teaser, $src, '173x');
			$company = $article['Company'];
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
	<ul class="description">
<?
	if ($company['address']) {
?>
		<li><strong><?__('Address');?>:</strong><br/><?=nl2br($company['address'])?></li>
<?
	}
	if ($company['phones']) {
?>
		<li><strong><?__('Phones');?>:</strong><br/><?=nl2br($company['phones'])?></li>
<?
	}
	if ($company['work_time']) {
?>
		<li><strong><?__('Work time');?>:</strong><br/><?=nl2br($company['work_time'])?></li>
<?
	}
	if ($company['site_url']) {
?>
		<li><strong><?__('Site');?>:</strong> <a href="http://<?=$company['site_url']?>" target="_blank"><?=$company['site_url']?></a> </li>
<?
	}
?>
	</ul>

								<p><?=$teaser?></p>
								<p class="more"><a href="<?=$url?>">подробнее</a></p>
							</div>
						</div>
<?
		}
?>
<?=$this->element('pagination2')?>
					</div>
				</div>
