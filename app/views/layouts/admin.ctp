<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width"/>

	<title>Админ-панель для <?=DOMAIN_TITLE?></title>

<?=$this->Html->charset()?>
<?=$this->Html->script(array('jquery'))?>
<?=$this->Html->css(array('common', 'admin', 'gzwStyles', 'jquery-ui.min', '/core/css/btn_icon'))?>

<?=$scripts_for_layout?>
<script type="text/javascript">
$(document).ready(function(){
	$('.autocompleteOff').attr('autocomplete', 'off');
});

function articleList_setFlag(_fieldName, id) {
	fieldName = _fieldName.replace(/\./, '__');
	var flag = $('#' + fieldName + '_' + id).hasClass('transparent');
	var img = $('#' + fieldName + '_' + id + ' img');
	$('#' + fieldName + '_' + id).removeClass('transparent');
	img.get(0).src = '/core/img/ajax_loader.gif';
	$.get('/adminAjax/setFlag/' + _fieldName + '/' + id + '/' + ((flag) ? '1' : '0'), function() {
		img.get(0).src = '/core/img/icons/checked.png';
		if (!flag) {
			$('#' + fieldName + '_' + id).addClass('transparent');
		}
	});
}

</script>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
		&nbsp;&nbsp;<a href="/admin/">Главная</a> | <a href="/">К сайту</a> | <a href="/admin/logout">Выход</a>
	</td>
	<td align="right">Добро пожаловать, <b>admin</b>!&nbsp;&nbsp;</td>
</tr>
</table>
<div align="center"><h1><?=DOMAIN_TITLE?> CMS</h1></div>
<?=$this->element('admin_menu')?>
<div class="hr"></div>
<table align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
		<!-- Content panel -->
		<?=$content_for_layout?>
		<!-- /Content panel -->
	</td>
</tr>
</table>
</body>
</html>