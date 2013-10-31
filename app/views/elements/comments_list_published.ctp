<td align="center">
<?
	$class = '';
	if (!$row['Comment']['published']) {
		$class = 'transparent';
	}
?>
	<?=$this->element('icon_action', array('plugin' => 'core', 'img' => 'checked.png', 'class' => $class, 'id' => 'Comment__published_'.$row['Comment']['id'], 'onclick' => "articleList_setFlag('Comment.published', {$row['Comment']['id']})"))?>
</td>