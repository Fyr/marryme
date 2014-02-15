Добавлен новый комментарий на сайте <?=DOMAIN_TITLE?>:<br />
Ссылка: <a href="http://<?=DOMAIN_NAME.$data['Contact']['url']?>"><?=$data['Contact']['url_title']?></a><br />
<? __('Username')?>: <?=$data['Contact']['username']?><br />
<? __('E-mail')?>: <a href="mailto:<?=$data['Contact']['email']?>"><?=$data['Contact']['email']?></a><br />
<br />
<? __('Message')?>:<br />
<span class="look">
<?=$data['Contact']['body']?>
</span>