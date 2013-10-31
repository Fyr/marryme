                <ul>
				    <li<?=($isHomePage) ? ' class="active"' : ''?>><a href="/"><?=$homePage['title']?></a></li>
<?
	foreach($aBottomLinks as $item => $menu) {
?>
					<li<?=($item == $currMenu) ? ' class="active"' : ''?>><a href="<?=$menu['href']?>"><?=$menu['title']?></a></li>
<?
	}
?>
                </ul>