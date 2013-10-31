<form id="postForm" name="postForm" action="#comment_form" method="post">
<div class="comments_head_title post_comment">Оставить комментарий</div>
<?
	if ($commentPosted) {
?>
	<div>
		<b>Спасибо за ваш комментарий!</b><br />
		<!--Ваш комментарий будет опубликован после проверки администратором.-->
	</div>
<?
	}
?>
<div class="comment_write_box">
<?
	if (isset($aErrFields['Comment'])) {
		$keys = array_keys($aErrFields['Comment']);
		$error = $aErrFields['Comment'][$keys[0]]; // show 1st error
?>
	<div class="invalid_box"><?=$error?></div>
<?
	}
	
	$username = $this->PHA->read($aComment, 'Comment.username');
	$email = $this->PHA->read($aComment, 'Comment.email');
	$body = $this->PHA->read($aComment, 'Comment.body');
?>
	<input type="text" id="data_Comment__username" name="data[Comment][username]" value="<?=$username?>" class="textbox"><br />
	<input type="text" id="data_Comment__email" name="data[Comment][email]" value="<?=$email?>" class="textbox"><br />
	<textarea id="data_Comment__body" name="data[Comment][body]"><?=$body?></textarea><br />
	<?=$this->element('comments_captcha', array('field' => 'Comment.captcha'))?>
	<div class="clear"></div>
	<a class="post_button" href="javascript:void(0)" onclick="comment_onSubmit()">Отправить</a>
</div>
</form>