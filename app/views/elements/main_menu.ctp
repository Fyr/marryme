				<ul class="no-touch">
				    <li<?=($isHomePage) ? ' class="current"' : ''?>><a href="/"><span><span><?=$homePage['title']?></span></span></a></li>
<?
	foreach($aMenu as $item => $menu) {
		if ($item !== 'products') {
?>
					<li<?=($item == $currMenu) ? ' class="current"' : ''?>>
						<a href="<?=$menu['href']?>"><span><span><?=$menu['title']?></span></span></a>
					</li>
<?
		} else {
?>
					<li class="expandable<?=($item == $currMenu) ? ' current' : ''?>">
						<a href="<?=$menu['href']?>"><span><span><?=$menu['title']?></span></span></a>
						<div class="drop_m">
							<div>
								<ul>
									<li><a href="<?=$this->Router->catUrl('brands', array('id' => 18, 'title' => '-'))?>">Свадебные платья</a></li>
									<li><a href="<?=$this->Router->catUrl('brands', array('id' => 19, 'title' => '-'))?>">Вечерние платья</a></li>
									<li><a href="/aksessuary/subcategories/">Аксессуары</a></li>
								</ul>
							</div>
						</div>
					</li>
<?
		}
	}
?>
                </ul>