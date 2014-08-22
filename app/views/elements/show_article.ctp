<?
	if (!isset($body)) {
		$body = $aArticle['Article']['body'];
	}
?>

<div class="article-show collapsed">
		<?=$this->HtmlArticle->fulltext($body)?>
</div>
<p class="more">
	<span class="expand">...</span>
	<a class="expand" href="javascript:void(0)">развернуть</a>
	<a class="collapse" href="javascript:void(0)">свернуть</a>
</p>
<script type="text/javascript">
$(document).ready(function(){
	$('.more a.expand').click(function(){
		$('.article-show').removeClass('collapsed');
		$('.article-show').hide();
		$('.article-show').slideDown('slow');
		
		$('.more .expand').hide();
		$('.more .collapse').show();
	});
	$('.more a.collapse').click(function(){
		$('.article-show').slideUp('slow', function(){
			$('.article-show').addClass('collapsed');
			$('.article-show').show();
			$('.more .expand').show();
			$('.more .collapse').hide();
		});
	});
});
</script>