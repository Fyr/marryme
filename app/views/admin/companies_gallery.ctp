<?
	$id = $this->PHA->read($aArticle, 'Article.id');
?>
<h2>Фотогалерея для компании "<?=$this->PHA->read($aArticle, 'Article.title');?>"</h2>
<?
	if ($id) {
?>
<div align="right" style="width: 550px">
	<a href="/admin/companiesEdit/<?=$id?>">Редактирование компании</a><br/>
	<a href="<?=$this->Router->url($aArticle)?>" target="_blank" title="<? __('View this page on site in a new tab');?>"><? __('View page');?></a>
</div>
<?
	}
?>
<?
	if ($id) {
?>
<form id="mediaForm" name="mediaForm" action="/media/media/submit/" method="post" enctype="multipart/form-data">
<input type="hidden" name="data[Media][inputName]" value="files" />
<input type="hidden" name="data[Media][object_type]" value="Company" />
<input type="hidden" name="data[Media][object_id]" value="<?=$this->PHA->read($aArticle, 'Article.id')?>" />
<input type="hidden" name="data[Media][makeThumb]" value="1" />
<?
	$backUrl = '/admin/companiesGallery/'.$id;
?>
<input type="hidden" name="data[backUrl]" value="<?=$backUrl?>" />
<br />
<?=$this->element('media_edit', array('plugin' => 'media', 'aMedia' => $aArticle['Media']))?>
</form>
<?
	}
?>