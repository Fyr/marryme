<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<?=$this->Html->script(array(
	'/js/flot/jquery.flot.min.js',
	'/js/flot/jquery.flot.time.min.js',
	'/js/gzw/statistics.js',
	'/js/gzw/datepickers.js',
	))?>
<!--[if lte IE 8]>
<?=$this->Html->script(array(
	'/js/flot/excanvas.min.js',
	))?>
<![endif]-->

<h2><? __('Statistics')?></h2>

<?
if (isset($jsonData)) extract($jsonData);
if (isset($viewData)) extract($viewData);
?>

<?
if (!count($errors)) :
?>

<script type="text/javascript">
	$(function () {
		obj = new datePicker();
		App.dpObjs.push(obj);
	});
</script>

<script type="text/javascript">
	$(function () {
		obj = new visitsGraph('<?=$jsonVisitsArr;?>');
		App.visitsGraphObj.push(obj);
		obj = new fromGraph('<?=$jsonFromArr;?>');
		App.fromGraphObj.push(obj);
		obj = new sEnginesGraph('<?=$jsonSEnginesData;?>');
		App.sEnginesGraphObj.push(obj);
	});
</script>

<div id="gzwStyles" class="row">
	<div class="row">
		<div class="row">
			<p><span>Выберите интервал для вывода статистики:</span></p>
		</div>
		<div id="presets" class="row">
			<div class="row">
				<form id="yesterdayForm" name="yesterdayForm" action="" method="POST">
					<input type="hidden" name="data[dates][for]" value="<? echo $todayFormDate;?>">
					<input type="hidden" name="data[dates][from]" value="<? echo $yesterdayFormDate;?>">
				</form>
				<form id="weekForm" name="weekForm" action="" method="POST">
					<input type="hidden" name="data[dates][for]" value="<? echo $todayFormDate;?>">
					<input type="hidden" name="data[dates][from]" value="<? echo $weekFormDate;?>">
				</form>
				<form id="monthForm" name="monthForm" action="" method="POST">
					<input type="hidden" name="data[dates][for]" value="<? echo $todayFormDate;?>">
					<input type="hidden" name="data[dates][from]" value="<? echo $monthFormDate;?>">
				</form>
				<p>
					<?=$this->element('btn_icon_action', array('plugin' => 'core', 'img'=> 'calendar.png', 'title' => 'Со вчера', 'onclick' => 'document.yesterdayForm.submit()'))?>
					<?=$this->element('btn_icon_action', array('plugin' => 'core', 'img'=> 'calendar.png', 'title' => 'За неделю', 'onclick' => 'document.weekForm.submit()'))?>
					<?=$this->element('btn_icon_action', array('plugin' => 'core', 'img'=> 'calendar.png', 'title' => 'За месяц', 'onclick' => 'document.monthForm.submit()'))?>
				</p>
			</div>
		</div>
	</div>
	<div class="row">
		<form id="handleForm" name="handleForm" action="" method="POST">
			<div id="dates" class="row">
				<p><span>или Укажите временной интервал вручную:</span></p>
				<p>
					<span>с:</span>
					<input type="text" value="<?=$dateFromForm;?>" autocomplete="off" name="data[dates][from]" class="datepicker-apply"/>
					<span>по:</span>
					<input type="text" value="<?=$dateForForm;?>" autocomplete="off" name="data[dates][for]" class="datepicker-apply"/>
				</p>
			</div>
			<div id="ready" class="row">
				<p>
					<?=$this->element('btn_icon_save', array('plugin' => 'core', 'title' => 'Обновить', 'onclick' => 'document.handleForm.submit()'))?>
				</p>
			</div>
		</form>
	</div>
	<div class="row hr"></div>
	<div class="row headblock">
		<h2><span>СТАТИСТИКА ПОСЕЩЕНИЙ</span></h2>
	</div>
	<div id="nowStatistics" class="row">
		<div class="row">
			<div class="row header">
				<p><span>Итого за период (<?=$total[2];?>):</span></p>
			</div>
			<div class="center20">
				<div class="row content">
					<table>
						<thead>
							<th>
								<p><span>Наименование</span></p>
							</th>
							<th>
								<p><span>Данные</span></p>
							</th>
						</thead>
						<tbody>
							<tr>
								<td class="one">
									<p><span>Просмотров:</span></p>
								</td>
								<td class="two">
									<b><?=$total[3];?></b>
								</td>
							</tr>
							<tr>
								<td class="one">
									<p><span>Визитов:</span></p>
								</td>
								<td class="two">
									<b><?=$total[4];?></b>
								</td>
							</tr>
							<tr>
								<td class="one">
									<p><span>Посетителей:</span></p>
								</td>
								<td class="two">
									<b><?=$total[5];?></b>
								</td>
							</tr>
							<tr>
								<td class="one">
									<p><span>Новых посетителей:</span></p>
								</td>
								<td class="two">
									<b><?=$total[6];?></b>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div id="visitsGraph" class="row">
		<div class="row content">
			<div id="visitsGraph-chart"></div>
		</div>
	</div>
	<div class="row headblock">
		<h2><span>ИСТОЧНИКИ ПЕРЕХОДОВ</span></h2>
	</div>
	<div id="fromGraph" class="row">
		<div class="row content">
			<div id="fromGraph-chart"></div>
		</div>
	</div>
	<div class="row headblock">
		<h2><span>СТАТИСТИКА ПО ПОИСКОВЫМ СИСТЕМАМ</span></h2>
	</div>
	<div id="sEnginesGraph" class="row">
		<div class="row content">
			<div id="sEnginesGraph-chart"></div>
		</div>
	</div>
	<div class="row headblock">
		<h2><span>ПОИСКОВЫЕ ФРАЗЫ</span></h2>
	</div>
	<div id="searchWords" class="row">
		<div class="row header">
			<p><span>За период: <?=$total[2];?></span></p>
		</div>
		<div class="row content">
			<div class="center60">
				<table>
					<thead>
						<th>
							<p><span>Поисковая фраза</span></p>
						</th>
						<th>
							<p><span>Количество</span></p>
						</th>
						<th>
							<p><span>Процент</span></p>
						</th>
						<th>
							<p><span>График</span></p>
						</th>
					</thead>
					<tbody>
						<? foreach ($words as $item) : ?>
						<tr>
							<td class="one">
								<p><span><?=$item['name'];?></span></p>
							</td>
							<td class="two">
								<p><span><?=$item['total'];?></span></p>
							</td>
							<td class="three">
								<p><span><? echo sprintf("%.02f", $val = ($item['total']/$wordsTotal) * 100);?> %</span></p>
							</td>
							<td class="four">
								<div id="wordGraph<?=$item['id'];?>" class="wordGraph" class="row">
									<div class="row content">
										<div class="wordGraph-chart"></div>
									</div>
								</div>
								<script type="text/javascript">
									var obj = new wordGraph($('#wordGraph<?=$item['id'];?>'), '<?=$item['days']?>');
									App.wordGraphObjs.push(obj);
								</script>
							</td>
						</tr>
						<? endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<? endif; ?>

<?
	if (isset($errors) && count($errors)) :
?>
	<div id="gzwStyles" class="row">
		<div class="row">
			<p><a href="<?=$_SERVER['REQUEST_URI'];?>">Вернуться назад</a></p>
		</div>
		<? foreach ($errors as $key=>$item) : ?>
			<div class="error">
				<div id="authMessage" class="message">
					<?=($key+1)?>. Код <?=$item['code'];?> - <?=$item['text']?>
				</div>
			</div>
		<? endforeach; ?>
	</div>
<?
	endif;
?>