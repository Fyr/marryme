<h3><span><span><span><?=$aArticle['Article']['title']?></span></span></span></h3>
<form id="postForm" name="postForm" action="" method="post">
<?=$this->element('article_view', array('plugin' => 'articles'))?>
<br/>
<a name="send"></a>
<h3><span><span><span>Отправить сообщение</span></span></span></h3>
<br />
<p><b>Ваше сообщение было успешно отправлено.<br/>
Спасибо за проявленный к нам интерес!</b></p>

</form>

