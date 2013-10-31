<?
	$iconset = 'iconset1';
	if ($paginator->numbers()) {
		if (isset($filterURL) && $filterURL) {
			$this->passedArgs['?'] = $filterURL;
		}

		$paginator->options(array('url' => $this->passedArgs));
?>
    <div class="pager">
    	<h5>Страница:</h5>
	    <?=$paginator->prev('Предыдущая', array('escape' => false))?>
    	<?=$paginator->numbers()?>
	    <?=$paginator->next('Следующая', array('escape' => false))?>
    </div>
<?
	}
?>