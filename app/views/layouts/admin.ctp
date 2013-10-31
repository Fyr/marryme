<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width"/>
	
	<title>Админ-панель для <?=DOMAIN_TITLE?></title>

<?=$this->Html->css(array('common', 'admin'))?>

<!-- YANDEX API && STATISTICS STUFF -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css" />
<script language="javascript" type="text/javascript" src="/js/flot/jquery.flot.min.js"></script>
<script language="javascript" type="text/javascript" src="/js/flot/jquery.flot.time.min.js"></script>
<!--[if lte IE 8]>
	<script language="javascript" type="text/javascript" src="/flot/excanvas.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/css/gzwStyles.css" />
<!-- END STATISTICS -->

<?
	// For categories
	echo $this->Html->css('/core/css/btn_icon');
?>

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