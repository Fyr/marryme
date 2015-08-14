<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?
	$title = $this->PHA->read($this->data, 'SEO.title');
	$title = ($title) ? $title : $pageTitle;
?>	
	<title><?=$title?></title>
	<?=$this->element('seo_info', array('plugin' => 'seo', 'data' => $this->PHA->read($this->data, 'SEO')))?>
<?=$this->Html->css(array('style', 'extra', 'edits'))?>
<?=$this->Html->script(array('modernizr-2.6.2.min', 'jquery', 'jquery.bxSlider.min', 'script', '/core/js/jquery.preload-images', 'preload', '/ddaccordion/js/ddaccordion', 'ddn', 'swfobject', 'tagcloud'))?>
<?=$scripts_for_layout?>
</head>
<body>
<?
	if (!TEST_ENV) {
?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter28676681 = new Ya.Metrika({id:28676681,
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
<noscript><div><img src="//mc.yandex.ru/watch/28676681" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?
	}
?>
<!-- preload -->
<div style="display: none">
	<img src="/img/category_border_on.png" alt="" />
	<img src="/img/drop_top.png" alt="" />
	<img src="/img/drop_bottom.png" alt="" />
	<img src="/img/navi_selected_seal.png" alt="" />
</div>
<!-- /preload -->
<div class="page_wrap">
	<div class="page_in">
		<div class="header title_page">
			<div class="header_in">
				<a href="/" class="logo"><img src="/img/logo.png" alt="Marry Me" /></a>
				<span class="h2">Салон свадебной<br/> и вечерней<br/> моды</span>
				<div class="lady"></div>
				<div class="lamp"></div>
				<p class="moto_1">Любовь окрыляет...</p>
				<p class="moto_2">Мы сделаем ваш полёт <span>сказочно красивым!!!</span></p>

				<div class="navigation">
					<?=$this->element('main_menu')?>
				</div>

				<div class="address">
					<?=$this->element('address')?>
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

			<div class="categories_selection">
					<div class="item">
						<span class="h3">Свадебные платья</span>
						<img src="/img/category_photo.jpg" alt="Свадебные платья" />
						<a href="<?=$this->Router->catUrl('brands', array('id' => 18, 'title' => '-'))?>" class="button"></a>
					</div>
					<div class="item">
						<span class="h3">Вечерние платья</span>
						<img src="/img/category_photo_2.jpg" alt="Вечерние платья" />
						<a href="<?=$this->Router->catUrl('brands', array('id' => 19, 'title' => '-'))?>" class="button"></a>
					</div>
					<div class="item">
						<span class="h3">Аксессуары</span>
						<img src="/img/category_photo_3.jpg" alt="Аксессуары" />
						<a href="/aksessuary/subcategories/" class="button"></a>
					</div>
				</div>
		</div>
	    
	<div class="article">
		<ul>
<?
	foreach($randomArticles as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '220x');
?>
		   <li>
		      <span></span>
		      <div style="background: url('<?=$src?>');">
		         <a href="<?=$url?>"><?=$title?></a>
		      </div>
		   </li>
<?
	}
?>
		</ul>
		<div class="clear"></div>
		<p class="more" style="margin: 2px"><a href="/articles/">Все статьи</a></p>
	</div>
		<div class="content">
			<div class="side_bar">
				<div class="side_in"><div class="side_in_in">

<?
	if (isset($showMainCategories) && $showMainCategories) {
?>
				<div class="block">
					<?=$this->element('sb_title', array('title' => 'Каталог'))?>
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
					<?=$this->element('sb_title', array('title' => 'Бренды'))?>
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
					<?=$this->element('sb_title', array('title' => 'Аксессуары'))?>
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
					<?=$this->element('sb_title', array('title' => 'Новости'))?>
					<div class="item">
<?
	$this->ArticleVars->init($upcomingEvent, $url, $title, $teaser);
?>
						<span class="h4"><?=$title?></span>
						<p><?=$teaser?></p>
						<p class="more"><a href="<?=$url?>">подробнее</a></p>
					</div>
				</div>

				<div class="block">
					<?=$this->element('banner')?>
				</div>
<?
	if (SHOW_BLOCK_FEATURED && $randomProducts) {
		echo $this->element('featured_products', array('title' => 'Акции', 'products' => $randomProducts, 'sticker' => 'new'));
	}
	if (SHOW_BLOCK_NEWS && $newProducts) {
		echo $this->element('featured_products', array('title' => 'Новинки', 'products' => $newProducts, 'sticker' => 'newproduct'));
	}
	if (SHOW_BLOCK_STOCK && $activeProducts) {
		echo $this->element('featured_products', array('title' => 'В наличии', 'products' => $activeProducts, 'sticker' => 'active'));
	}
	if (SHOW_BLOCK_AWAY && $pendingProducts) {
		echo $this->element('featured_products', array('title' => 'В пути', 'products' => $pendingProducts, 'sticker' => 'pending'));
	}
?>

				<div class="block">
					<?=$this->element('sb_search_form')?>
				</div>

				<div class="block">
					<a href="javascript:void(0)" onclick="var url='http://gfc.by'; window.location.href=url;"><img src="/img/gfc.png" alt="Grand Fiesta Company"/></a>
				</div>
<?
	if (!TEST_ENV) {
?>
				<div class="block">
<object data="http://inpro.by/1/Social_tabs_240x400.html" name="social_frame"></object>
				</div>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53239655-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Код тега ремаркетинга Google -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 948513588;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/948513588/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?
	}
?>
				<div class="block tag-cloud">
					<?//$this->element('tag_cloud')?>
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

<?=$this->element('footer')?>
<?//$this->element('sql_dump')?>
</body>
</html>