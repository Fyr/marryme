<div class="footer">
	<div class="footer_in">
			<a href="/" class="logo"><img src="/img/footer_logo.jpg" alt="Marry Me" /></a>
			<span class="h6">Салон свадебной<br/> и вечерней<br/> моды</span>
			<div class="navigation">
				<?=$this->element('bottom_links')?>
			</div>

			<div class="address">
				<?=$this->element('address')?>
				<!--noindex-->
				<a href="https://plus.google.com/u/0/101878855187512164541?rel=author" rel="me" target="_blank"><img title="Присоединиться в Google+" src="/img/icons/google-plus.png" alt="Присоединиться в Google+" class="gplusico"></a>
				<a href="http://vk.com/club47611192" target="_blank"><img src="/img/icons/vk.png" alt="Присоединиться ВКонтакте"/></a>
				<!--/noindex-->
<?
	if (!TEST_ENV) {
?>
<!--LiveInternet counter--><script type="text/javascript"><!--
new Image().src = "//counter.yadro.ru/hit?r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random();//--></script><!--/LiveInternet-->
<?
	}
?>
			</div>
	</div>
</div>

<div id="ovl"></div>
<?
	if (!TEST_ENV) {
?>
<script async="async" src="https://w.uptolike.com/widgets/v1/zp.js?pid=46282"></script>
<?
	}
?>