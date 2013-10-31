<?
	list($model, $field) = explode('.', $field);
?>
<img class="captcha" src="/captcha/captcha/index/<?=$captchaKey?>" width="120" height="56" alt="<? __('SPAM PROTECTION! Enter the text on image');?>" />
<input type="hidden" name="data[<?=$model?>][captcha_q]" value="<?=$captchaKey?>"/>
<span class="spam_protection">Защита от спама:</span><br>
<input type="text" id="data_<?=$model?>__<?=$field?>" name="data[<?=$model?>][<?=$field?>]" value="Текст на картинке" class="textbox captha_text">