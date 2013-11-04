<?
	$this->Html->script('/articles/js/translit_utf', array('inline' => false));
?>
<table class="pad5" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td colspan="2">
		<input type="checkbox" id="Article.published" name="data[Article][published]" value="1" <?=($this->PHA->read($aArticle, 'Article.published')) ? 'checked="checked"' : ''?> /> <? __('Published');?>
		<input type="checkbox" id="Article.featured" name="data[Article][featured]" value="1" <?=($this->PHA->read($aArticle, 'Article.featured')) ? 'checked="checked"' : ''?> /> <? __('New!!!');?>
		<input type="checkbox" id="Article.is_active" name="data[Article][is_active]" value="1" <?=($this->PHA->read($aArticle, 'Article.is_active')) ? 'checked="checked"' : ''?> /> <? __('Active');?>
		<input type="checkbox" id="Article.is_pending" name="data[Article][is_pending]" value="1" <?=($this->PHA->read($aArticle, 'Article.is_pending')) ? 'checked="checked"' : ''?> /> <? __('Pending');?>
		<input type="checkbox" id="Article.is_new" name="data[Article][is_new]" value="1" <?=($this->PHA->read($aArticle, 'Article.is_new')) ? 'checked="checked"' : ''?> /> <? __('Is_New');?>
	</td>
</tr>
<?//$this->element('std_input', array('plugin' => 'core', 'class' => 'autocompleteOff', 'caption' => __('Brand', true), 'field' => 'Article.brand_id', 'data' => $aArticle, 'required' => true, 'input' => 'dropdown', 'options' => $aBrandOptions))?>
<?=$this->element('std_input', array('plugin' => 'core', 'caption' => __('Title', true), 'class' => 'autocompleteOff', 'required' => true, 'field' => 'Article.title', 'data' => $aArticle, 'size' => 78, 'onkeyup' => 'article_onChangeTitle()'))?>
<?//$this->element('std_input', array('plugin' => 'core', 'caption' => __('Page ID', true), 'class' => 'autocompleteOff', 'field' => 'Article.page_id', 'data' => $aArticle, 'size' => 78, 'onchange' => 'article_onChangePageID()'))?>
<?=$this->element('std_input', array('plugin' => 'core', 'caption' => __('Price', true), 'class' => 'autocompleteOff', /*'required' => true,*/ 'field' => 'Article.price', 'data' => $aArticle, 'size' => 5))?>
<?=$this->element('std_input', array('plugin' => 'core', 'caption' => __('Price2', true), 'class' => 'autocompleteOff', /*'required' => true,*/ 'field' => 'Article.price2', 'data' => $aArticle, 'size' => 5))?>
<?=$this->element('std_input', array('plugin' => 'core', 'caption' => __('Sorting', true), 'class' => 'autocompleteOff', /*'required' => true,*/ 'field' => 'Article.sorting', 'data' => $aArticle, 'size' => 5))?>
<script type="text/javascript">
var pageID_EditMode = <?=(($this->PHA->read($aArticle, 'Article.page_id'))) ? 'true' : 'false'?>;
function article_onChangeTitle() {
	if (!pageID_EditMode) {
		$('#Article__page_id').val(translit($('#Article__title').val()));
	}
}

function article_onChangePageID() {
	pageID_EditMode = ($('#Article__page_id').val() && true);
}

function translit(str) {
	return ru2en.tr_url(str);
}
</script>

<tr>
	<td colspan="2">
		<? __('Teaser'); ?><br />
		<textarea name="data[Article][teaser]" rows="1" cols="40" style="width: 550px; height: 100px"><?=$this->PHA->read($aArticle, 'Article.teaser')?></textarea>
	</td>
</tr>
<tr>
	<td colspan="2">
		<? __('Body'); ?><br />
		<?=$this->PHFcke->textarea("data_Article__body_", $this->PHA->read($aArticle, 'Article.body'), 'Small')?>
	</td>
</tr>
<tr>
	<td align="center" colspan="2">
		<?=$this->element('btn_icon_save', array('plugin' => 'core', 'onclick' => 'document.articleForm.submit()'))?>
		<?//$this->element('btn_icon_save', array('plugin' => 'core', 'onclick' => 'document.articleForm.submit()', 'title' => __('Save & View list', true)))?>
	</td>
</tr>
</table>
<!--
</fieldset>
-->