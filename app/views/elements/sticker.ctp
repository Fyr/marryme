<?
			if ($article['Article']['featured']) {
?>
								<span class="sticker new"></span>
<?
			} elseif ($article['Article']['is_active']) {
?>
								<span class="sticker active"></span>
<?
			} elseif ($article['Article']['is_pending']) {
?>
								<span class="sticker pending"></span>
<?
			} elseif ($article['Article']['is_new']) {
?>
								<span class="sticker newproduct"></span>
<?
			}
?>