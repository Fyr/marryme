<a name="comment_form"></a>
<form id="postForm" name="postForm" action="#comment_form" method="post">

<p>Поля с пометкой <span class="required">*</span> обязательны для заполнения.</p>
<div class="box">
<?
	if (isset($aErrFields['Contact'])) {
?>
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
<?
	}
?>
<table class="pad5">
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