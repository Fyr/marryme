<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?=$this->Html->charset()?>

<style>
body, form, td, th, input, textarea, p, div {
	font-size: 13px;
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	color: #515862; 
	vertical-align:top;
}
img {
	border: none;
}
</style>
</head>
<body>
<?=$content_for_layout?>
<br /><br />
<em>
С уважением, <br />
&nbsp;&nbsp;&nbsp;Администрация сайта <a href="http://<?=DOMAIN_NAME?>"><?=DOMAIN_TITLE?></a>
</em>
</body>
</html>