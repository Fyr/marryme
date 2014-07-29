<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language" content="ru"/>
	<title><?=$pageTitle?></title>
	<?=$this->element('seo_info', array('plugin' => 'seo', 'data' => $this->PHA->read($this->data, 'SEO')))?>
<?=$this->Html->css(array('style', 'extra', 'edits'))?>
<?=$this->Html->script(array('modernizr-2.6.2.min', 'jquery', 'jquery.bxSlider.min', 'script', '/core/js/jquery.preload-images', 'preload', '/ddaccordion/js/ddaccordion', 'ddn', 'swfobject', 'tagcloud'))?>
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
					<?=$this->element('title', array('title' => 'Каталог'))?>
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
					<?=$this->element('title', array('title' => 'Бренды'))?>
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
					<?=$this->element('title', array('title' => 'Аксессуары'))?>
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
					<?=$this->element('title', array('title' => 'Новости'))?>
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
					<?=$this->element('banner')?>
				</div>
<?
	if (SHOW_BLOCK_FEATURED && $randomProducts) {
?>
				<div class="block">
					<?=$this->element('title', array('title' => 'Акции'))?>
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
<?
	}
	if (SHOW_BLOCK_NEWS && $newProducts) {
?>
				<div class="block">
					<?=$this->element('title', array('title' => 'Новинки'))?>
					<div class="new_items">
<?
		foreach($newProducts as $article) {
			$this->ArticleVars->init($article, $url, $title, $teaser, $src, '113x');
?>
						<div class="item">
							<div class="image">
								<a href="<?=$url?>"><img src="<?=$src?>" alt="<?=$title?>"/></a>
								<span class="sticker newproduct"></span>
							</div>
							<h4><a href="<?=$url?>"><?=$title?></a></h4>
						</div>
<?
		}
?>
					</div>
				</div>
<?
	}
	if (SHOW_BLOCK_STOCK && $activeProducts) {
?>
				<div class="block">
					<?=$this->element('title', array('title' => 'В наличии'))?>
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
<?
	}
?>

<?
	if (SHOW_BLOCK_AWAY && $pendingProducts) {
?>
				<div class="block">
					<?=$this->element('title', array('title' => 'В пути'))?>
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
<?
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
<iframe width="240" scrolling="no" height="390" frameborder="0" style="border:0px none;" noresize="" marginheight="0" marginwidth="0" src="http://inpro.by/1/Social_tabs_240x400.html" name="social_frame"></iframe>
				</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53239655-1', 'auto');
  ga('send', 'pageview');

</script>
<?
	}
?>
				<div class="block tag-cloud">
					<?=$this->element('tag_cloud')?>
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
</body>
</html>