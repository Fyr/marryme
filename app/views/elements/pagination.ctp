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
	    <?=$this->Router->transformPageParams($objectType, $paginator->prev('Предыдущая', array('escape' => false)))?>
    	<?=$this->Router->transformPageParams($objectType, $paginator->numbers())?>
	    <?=$this->Router->transformPageParams($objectType, $paginator->next('Следующая', array('escape' => false)))?>
    </div>
<?
	}
?>