<?
	foreach($aComments as $comment) {
?>
	<div class="comment_item">
		<!-- img align="left" alt="" src="upload/comment_thumbs1.jpg" avatar -->
		<a class="name" href="javascript:void(0)"><?=htmlspecialchars($comment['Comment']['username'])?></a>
		<div class="comment_text"><?=nl2br(htmlspecialchars($comment['Comment']['body']))?></div>
		<div class="comment_date"><?=$this->PHTime->niceShort($comment['Comment']['created'])?></div>
	</div>
<?
	}
?>
<script type="text/javascript">
<?
	$params = $this->Paginator->params();
?>
var commentTotalPages = <?=$params['pageCount']?>;
</script>