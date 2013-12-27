<?
	if ($row['Comment']['object_type'] == 'Guestbook') {
		$url = '/feedback/';
		$title = 'Отзывы';
	} else {
		$this->ArticleVars->init($row, $url, $title, $teaser, $src, 'noresize');
	}
?>
<?=$this->element('icon_action', array('plugin' => 'core', 'img' => 'view_item.gif', 'href' => $url, 'title' => $title))?>