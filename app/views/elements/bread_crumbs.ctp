<div class="breadcrumbs">
<?
	if ($aItems) {
		foreach($aItems as $url => $title) {
			if ($url) {
				echo "&nbsp;<a href=\"{$url}\">{$title}</a>";
			} else {
				echo "&nbsp;<strong>{$title}</strong>";
			}
		}
	}
?>
</div>