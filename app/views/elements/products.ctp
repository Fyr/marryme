<?
	foreach($randomProducts['images'] as $media) {
		$media = $media['Media'];
		$src = $this->PHMedia->getUrl($media['object_type'], $media['id'], '305x', $media['file'].$media['ext']);
?>
								<a href="" class="picture">
									<img src="<?=$src?>" alt="Посмотреть основной каталог продукции" />
									<span class="light"></span>
								</a>
<?
	}
?>
								<a href="#" class="more">подробнее</a>