<?
	$this->Html->script('comments', array('inline' => false));
?>
<br />
<a name="comment_form"></a>
<?=$this->element('_comments_form')?>
<script type="text/javascript">
$(document).ready(function () {
	initCommentsForm();
	$('.comment_write_box textarea').autoResize({extraSpace : 10 });
});
</script>
