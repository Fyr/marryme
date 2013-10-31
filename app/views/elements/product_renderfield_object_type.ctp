<td>
<?
	if (isset($aCollectionBrands[$row['Article']['object_id']]) && isset($aBrandOptions[$aCollectionBrands[$row['Article']['object_id']]])) {
		echo $aBrandOptions[$aCollectionBrands[$row['Article']['object_id']]];
	} else {
		echo '-';
	}
?>
</td>