                <ul class="categories">
<?
	foreach($aUserMenu as $item => $menu) {
?>
					<li class="separator"></li>
					<li<?=($item == $currUserMenu) ? ' class="active"' : ''?>><a href="<?=$menu['href']?>"><?=$menu['title']?></a></li>
<?
	}
?>
                </ul>