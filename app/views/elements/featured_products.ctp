				<div class="block">
					<?=$this->element('sb_title', array('title' => $title))?>
					<div class="new_items">
<?
		foreach($products as $article) {
			$this->ArticleVars->init($article, $url, $title, $teaser, $src, 'thumb105x141');
?>
						<div class="item">
							<div class="image">
								<a href="<?=$url?>"><img src="<?=$src?>" alt="<?=$title?>"/></a>
								<span class="sticker <?=$sticker?>"></span>
							</div>
							<div class="shadow"></div>
							<span class="h4"><a href="<?=$url?>"><?=$title?></a></span>
						</div>
<?
		}
?>
					</div>
				</div>
