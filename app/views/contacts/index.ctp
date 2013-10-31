<style type="text/css">
.mapContainer img {
	cursor: pointer;
}
</style>
<h3><span><span><span><?=$aArticle['Article']['title']?></span></span></span></h3>
<div class="block mapContainer">
	<?=$this->element('article_view', array('plugin' => 'articles'))?>
	<br/>
	<div style="clear: both;"></div>
</div>

<h3><span><span><span>Отправить сообщение</span></span></span></h3>
<form id="postForm" name="postForm" action="" method="post">
<p>Поля с пометкой <span class="required">*</span> обязательны для заполнения.</p>
<div class="box">
<div class="error">
<?
		foreach($aErrFields['Contact'] as $field => $err_msg) {
?>
			<?=$err_msg?><br />
<?
		}
?>
<br />
</div>
<table class="pad5" border="0" cellpadding="0" cellspacing="0">
<?=$this->element('std_input', array('plugin' => 'core', 'caption' => __('Your name', true), 'required' => true, 'field' => 'Contact.username', 'data' => $this->data))?>
<?=$this->element('std_input', array('plugin' => 'core', 'caption' => __('Your e-mail for reply', true), 'required' => true, 'field' => 'Contact.email', 'data' => $this->data))?>
<tr>
	<td colspan="2">
		<span class="required">*</span> Текст сообщения:<br/>
		<textarea cols="46" rows="5" name="data[Contact][body]"><?=$this->PHA->read($data, 'Contact.body')?></textarea>
	</td>
</tr>
<tr>
	<td class="captcha" colspan="2">
		<?=$this->element('captcha_img', array('plugin' => 'captcha', 'field'=> 'Contact.captcha', 'captcha_key' => $captchaKey, 'aErrFields' => $aErrFields))?>
	</td>
</tr>
<tr>
	<td colspan="2">
		<?=$this->element('button', array('caption' => 'Send', 'onclick' => 'document.postForm.submit();'))?>
	</td>
</tr>
</table>
</div>

<input type="hidden" name="data[send]" value="1" />
</form>

<script type="text/javascript">
$(document).ready(function(){
	$('.mapContainer img').click(function(){
		window.open(this.src, null, 'width=900&height=500');
	});
});
</script>