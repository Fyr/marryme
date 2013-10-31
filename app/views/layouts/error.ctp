<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language" content="ru"/>
	<title><?=$pageTitle?></title>
<?=$this->Html->css(array('style', 'extra', 'edits'))?>
<?=$this->Html->script(array('jquery', 'jquery.bxSlider.min', 'script'))?>
<?=$scripts_for_layout?>
</head>
<body>
<div class="page_wrap">
	<div class="page_in">
		<div class="header title_page">
			<div class="header_in">
				<a href="/" class="logo"><img src="/img/logo.png" alt="Marry Me" /></a>
				<h1>Салон свадебной<br/>и вечерней<br/>моды</h1>
				<div class="lady"></div>
				<div class="lamp"></div>
				<p class="moto_1">Любовь окрыляет...</p>
				<p class="moto_2">Мы сделаем ваш полёт <span>сказочно красивым!!!</span></p>

				<div class="navigation">
					<?=$this->element('main_menu')?>
				</div>

				<div class="address">
					<p class="phone">(044) 765 67 78</p>
					<p class="phone">(044) 567 89 98</p>
					<address>г.Минск, ул.Кульман 15</address>
				</div>

				<div class="slider">
					<ul>
						<li><img src="/img/top_slide_photo.jpg" alt="" /></li>
						<li><img src="/img/top_slide_photo_2.jpg" alt="" /></li>
						<li><img src="/img/top_slide_photo_3.jpg" alt="" /></li>
					</ul>
				</div>
			</div>
<?
	if ($this->params['controller'] == 'pages' && $this->params['action'] == 'home') {
?>
			<div class="categories_selection">

					<div class="item">
						<h3>Свадебные платья</h3>
						<img src="/img/category_photo.jpg" alt="" />
						<a href="/brands/index/18" class="button"></a>
					</div>
					<div class="item">
						<h3>Вечерние платья</h3>
						<img src="/img/category_photo_2.jpg" alt="" />
						<a href="/brands/index/19" class="button"></a>
					</div>
					<div class="item">
						<h3>Аксессуары</h3>
						<img src="/img/category_photo_3.jpg" alt="" />
						<a href="/products/?data[filter][Article.object_id]=20" class="button"></a>
					</div>
				</div>
		</div>
<?
	} else {
?>
	<div class="categories_selection" style="background: none; height: 46px;"></div>
<?
	}
?>
		<div class="content">
			<div class="side_bar">
			</div>

			<div class="main_content">
<?
	if (TEST_ENV) {
		echo $content_for_layout;
	} else {
?>
									<div style="height: 300px">
										<h4>Страница не найдена</h4>
									      <p>Извините, запрашиваемая вами страница не существует.<br />
									      Воспользуйтесь навигацией или поиском, чтобы найти необходимую вам информацию.<br />
									      <br />
									      <a href="/">Перейти на Главную</a>
									      </p>
									</div>
<?
	}
?>
			</div>
		</div>
	</div>
</div>

<div class="footer">
	<div class="footer_in">
			<a href="" class="logo"><img src="/img/footer_logo.jpg" alt="Marry Me" /></a>
			<h6>Салон свадебной<br/>и вечерней<br/>моды</h6>
			<div class="navigation">
				<?=$this->element('bottom_links')?>
			</div>

			<div class="address">
				<p class="phone">(044) 765 67 78</p>
				<p class="phone">(044) 567 89 98</p>
				<address>г.Минск, ул.Кульман 15</address>
				<address>Copyright © 2012 MarryMe</address>
			</div>
	</div>
</div>

<div id="ovl"></div>

</body>
</html>