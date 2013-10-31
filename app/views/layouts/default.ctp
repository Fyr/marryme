<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language" content="ru"/>
	<title><?=$pageTitle?></title>
	<?=$this->element('seo_info', array('plugin' => 'seo', 'data' => $this->PHA->read($this->data, 'SEO')))?>
<?=$this->Html->css(array('style', 'extra', 'edits'))?>
<?=$this->Html->script(array('jquery', 'jquery.bxSlider.min', 'script', '/core/js/jquery.preload-images', 'preload', '/ddaccordion/js/ddaccordion', 'ddn'))?>
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
					<p class="phone">8 029 333 33 79 V</p>
					<p class="phone">8 029 555 55 79 M</p>
					<address>г.Минск, ул.Кульман 15</address>
				</div>

				<div class="slider">
					<ul>
<?
	foreach($aSlider as $media) {
		$media = $media['Media'];
		$src = $this->PHMedia->getUrl($media['object_type'], $media['id'], '186x', $media['file'].$media['ext']);
?>
						<li><img src="<?=$src?>" alt="" /></li>
<?
	}
?>
					</ul>
				</div>
			</div>
<?
	if ($this->params['controller'] == 'pages' && $this->params['action'] == 'home') {
?>
			<div class="categories_selection">

					<div class="item">
						<h3>Свадебные платья</h3>
						<img src="/img/category_photo.jpg" alt="Свадебные платья" />
						<a href="/svadebnye-platjya-18/brands/" class="button"></a>
					</div>
					<div class="item">
						<h3>Вечерние платья</h3>
						<img src="/img/category_photo_2.jpg" alt="Вечерние платья" />
						<a href="/vechernie-platjya-19/brands/" class="button"></a>
					</div>
					<div class="item">
						<h3>Аксессуары</h3>
						<img src="/img/category_photo_3.jpg" alt="Аксессуары" />
						<a href="/aksessuary-20/subcategories/" class="button"></a>
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
				<div class="side_in"><div class="side_in_in">

<?
	if (isset($showMainCategories) && $showMainCategories) {
?>
				<div class="block">
					<h3><span><span><span>Каталог</span></span></span></h3>
					<div class="ddnMenu">
<?
		foreach($aMainCategories as $category) {
			$url = $this->Router->catUrl(($category['Category']['id'] == 20) ? 'subcategories' : 'brands', $category['Category']);
?>
						<div class="ddnHeader">
							<a href="<?=$url?>"><?=$category['Category']['title']?></a>
						</div>
<?
		}
?>
					</div>
				</div>
<?
	}
	if (isset($showSBCategories) && $showSBCategories) {
?>
				<div class="block">
					<h3><span><span><span>Бренды</span></span></span></h3>
					<div class="ddnMenu">
<?
		foreach($aBrandCollections as $brandID => $aID) {
?>
						<div class="ddn-header">
							<a href="javascript:void(0)"><?=$aBrandOptions[$brandID]?></a>
						</div>
						<div class="ddn-submenu">
<?
			foreach($aID as $_id) {
?>

						<p class="more"><a href="<?=$this->Router->url($aCatCollections[$_id])?>"><?=$aCollectionOptions[$_id]?></a></p>
<?
			}
?>
						</div>
<?
		}
?>
					</div>
				</div>
<?
	}
	if (isset($showAcsCategories) && $showAcsCategories) {
?>
				<div class="block">
					<h3><span><span><span>Аксессуары</span></span></span></h3>
					<div class="ddnMenu">
<?
		foreach($aAcsCategories as $article) {
			$url = $this->Router->url($article);
?>
						<div class="ddnHeader">
							<a href="<?=$url?>"><?=$article['Article']['title']?></a>
						</div>
<?
		}
?>
					</div>
				</div>
<?
	}
?>
				<div class="block">
					<h3><span><span><span>Новости</span></span></span></h3>
					<div class="item">
<?
	$this->ArticleVars->init($upcomingEvent, $url, $title, $teaser);
?>
						<h4><?=$title?></h4>
						<p><?=$teaser?></p>
						<p class="more"><a href="<?=$url?>">подробнее</a></p>
					</div>
				</div>

				<div class="block">
					<h3><span><span><span>Акции</span></span></span></h3>
					<div class="new_items">
<?
	foreach($randomProducts as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '113x');
?>
						<div class="item">
							<div class="image">
								<a href="<?=$url?>"><img src="<?=$src?>" alt="<?=$title?>"/></a>
								<span class="sticker new"></span>
							</div>
							<h4><a href="<?=$url?>"><?=$title?></a></h4>
						</div>
<?
	}
?>
					</div>
				</div>
				<div class="block">
					<h3><span><span><span>В наличии</span></span></span></h3>
					<div class="new_items">
<?
	foreach($activeProducts as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '113x');
?>
						<div class="item">
							<div class="image">
								<a href="<?=$url?>"><img src="<?=$src?>" alt="<?=$title?>"/></a>
								<span class="sticker active"></span>
							</div>
							<h4><a href="<?=$url?>"><?=$title?></a></h4>
						</div>
<?
	}
?>
					</div>
				</div>
				<div class="block">
					<h3><span><span><span>В пути</span></span></span></h3>
					<div class="new_items">
<?
	foreach($pendingProducts as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '113x');
?>
						<div class="item">
							<div class="image">
								<a href="<?=$url?>"><img src="<?=$src?>" alt="<?=$title?>"/></a>
								<span class="sticker pending"></span>
							</div>
							<h4><a href="<?=$url?>"><?=$title?></a></h4>
						</div>
<?
	}
?>
					</div>
				</div>
				<div class="block">
					<?=$this->element('sb_search_form')?>
				</div>


				</div></div>
			</div>

			<div class="main_content">
<?
	if ($aBreadCrumbs) {
		echo $this->element('bread_crumbs', array('aItems' => $aBreadCrumbs));
	}
?>
				<?=$content_for_layout?>
			</div>
		</div>
	</div>
</div>

<div class="footer">
	<div class="footer_in">
			<a href="/" class="logo"><img src="/img/footer_logo.jpg" alt="Marry Me" /></a>
			<h6>Салон свадебной<br/>и вечерней<br/>моды</h6>
			<div class="navigation">
				<?=$this->element('bottom_links')?>
			</div>

			<div class="address">
				<p class="phone">8 029 333 33 79 V</p>
				<p class="phone">8 029 555 55 79 M</p>
				<address>г.Минск, ул.Кульман 15</address>
				<address style="margin-top: 20px; font-size: 11px; font-family: minion_proregular">Разработка сайта: <a href="mailto:fyr@tut.by">fyr@tut.by</a></address>
			</div>
	</div>
</div>

<div id="ovl"></div>
<?
	if (!TEST_ENV) {
?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter19619107 = new Ya.Metrika({id:19619107,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/19619107" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?
	}
?>
</body>
</html>