<?
if (SHOW_PRICE) {
?>
<span class="small prices">
	<div><?=$this->Price->format(__('Price', true).':<br/>', $article['Article']['price'])?></div>
<?
	if (isset($article['Article']['price2'])) {
?>
	<div class="price2"><?=$this->Price->format(__('Price2', true).':<br/>', $article['Article']['price2'])?></div>
<?
	}
?>
</span>
<?
}
?>