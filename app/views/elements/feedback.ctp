<?=$this->element('title', array('title' => 'Отзывы'))?>
<div class="block">
<div class="news_block">
<?
	foreach($aComments as $comment) {
?>
	<p><span class="date"><?=date('d.m.Y', strtotime($comment['Comment']['created']))?></span>&nbsp;&nbsp;&nbsp;<b><?=($comment['Comment']['username'])?></b> <br/>
		<?=($comment['Comment']['body'])?>
	</p>
<?
	}
?>
</div>
<?=$this->element('pagination', array('objectType' => 'Feedback'))?>
</div>