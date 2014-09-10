<?
	if (in_array($objectType, array('articles', 'news', 'products'))) {
		echo $this->element('share');
		if ($aComments) {
?>
<?=$this->element('title', array('title' => 'Комментарии к статье'))?>
<?=$this->element('feedback')?>
<?
		}
?>
<?=$this->element('title', array('title' => 'Оставить комментарий'))?>
<?=$this->element('_comments_form')?>
<?
	}
?>