<div class="errMsg"><?=$this->Session->flash('auth')?></div>
<form action="" method="post">
<input type="hidden" value="POST" name="_method"/>
<table border="0" cellpadding="5" cellspacing="5">
<tr>
	<td><? __('E-mail');?></td>
	<td><input type="text" name="data[User][email]" value="<?=$this->PHA->read($data, 'User.email')?>" /></td>
</tr>
<tr>
	<td><? __('Password')?></td>
	<td><input type="password" value="" name="data[User][password]"/></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="<? __('Login')?>" /></td>
</tr>
</table>
</form>