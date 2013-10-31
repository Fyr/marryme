<?
	$selected = isset($selected) ? $selected : '';
	if (isset($empty) && $empty) {
?>
<option value="">- <? __('Choose category');?> -</option>
<?
	}
	foreach($aCategoryOptions as $id => $title) {
?>
<option value="<?=$id?>"<?=($selected == $id) ? ' selected="selected"' : ''?>><?=$title?></option>
<?
	}
?>