<?
	$this->Html->script('autoresize.jquery.min.js', array('inline' => false));
	$this->Html->css('comments', null, array('inline' => false));
?>
<a name="comments"></a>
<div class="comments">
<?
	if ($aComments) {
		$commentsCount = (isset($aArticle['Stat']['comments']) && $aArticle['Stat']['comments']) ? ' ('.$aArticle['Stat']['comments'].')' : '';
?>
	<div class="comments_head_title">Комментарии<?=$commentsCount?></div>
	<div class="commentItems">
		<?=$this->element('more_comments')?>
	</div>

<script type="text/javascript">
var commentPage = 1;
var commentLimit = <?=$grid['Comment']['limit']?>;

function moreComments() {
	commentPage++;
	$('.processing').show();
	$('#moreCommentsBtn').hide();
	$.get('/ajax/moreComments/<?=$objectType?>/<?=$aArticle['Article']['id']?>/page:' + commentPage, null, function(data) {
		$('.commentItems').append(data);
		$('.processing').hide();
		$('#moreCommentsBtn').show();
		if (commentPage >= commentTotalPages) {
			$('#moreCommentsBtn').hide();
			$('#lessCommentsBtn').show();
		}
	});
}

function hideComments() {
	$('.commentItems').html('');
	$('#lessCommentsBtn').hide();
	commentPage = 0;
	moreComments();
}
</script>
<?
		$params = $this->Paginator->params();
		if ($params['pageCount'] > 1) {
?>
	<div id="moreCommentsBtn" class="comment_write_box all_comments" onclick="moreComments()">Показать еще комментарии</div>
	<div id="lessCommentsBtn" class="comment_write_box all_comments" onclick="hideComments()" style="display: none">Спрятать комментарии</div>

<?///$this->element('btn_icon_action', array('plugin' => 'core', 'id' => 'moreCommentsBtn', 'onclick' => 'moreComments()', 'title' => __('More comments...', true)))?>
<?=$this->element('processing', array('plugin' => 'core'))?>
<?
		}
	}
?>
<?=$this->element('comments_form')?>
</div>