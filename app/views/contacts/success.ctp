<?=$this->element('title', array('title' => $aArticle['Article']['title']))?>
<form id="postForm" name="postForm" action="" method="post">
<div>
<?=$this->element('article_view', array('plugin' => 'articles'))?>
</div>
<br/>
<a name="send"></a>
<?=$this->element('title', array('title' => 'Отправить сообщение'))?>
<br />
<p><b>Ваше сообщение было успешно отправлено.<br/>
Спасибо за проявленный к нам интерес!</b></p>

</form>

