<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td valign="top">
<?
	$count = -1;
	foreach($aTags as $id => $title) {
		$count++;
		if (!($count % 5) && $count > 0) {
?>
	</td>
	<td valign="top">
<?
		}
		$checked = (in_array($id, $aRelatedTags)) ? ' checked="checked"' : '';
?>
			<input class="checkbox" type="checkbox" name="tag[]" value="<?=$id?>" onclick="tag_onBind(<?=$id?>, '<?=$object_type?>', <?=$object_id?>)" <?=$checked?>/><?=$title?>
	<br />
<?
	}
?>
	</td>
</tr>
</table>