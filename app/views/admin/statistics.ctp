<h2><? __('Statistics')?></h2>

<?
if (isset($jsonData)) extract($jsonData);
if (isset($viewData)) extract($viewData);
?>

<?
if (!count($errors)) :
?>

<script type="text/javascript">
	var visitsGraph = function () {
		var self = this;
		self._getter = {
			start: '#visitsGraph',
			placeholder: '#visitsGraph-chart'
		};
		self._objects = {};
		self._buffer = {
			data : [
				{	
					label: 'Посещения',
					data: $.parseJSON('<? echo $json_pageviews; ?>'),
					color: "rgba(0, 180, 255, 1)",
					bars: {
						fillColor: "rgba(0, 180, 255, 1)",
					}							
				},
				{	
					label: 'Визиты',
					data: $.parseJSON('<? echo $json_visits; ?>'),
					color: "rgba(255, 255, 0, 1)",
					bars: {
						fillColor: "rgba(255, 255, 0, 1)",
					}							
				},
				{	
					label: 'Посетители',
					data: $.parseJSON('<? echo $json_visitors; ?>'),
					color: "rgba(255, 0, 0, 1)",
					bars: {
						fillColor: "rgba(255, 0, 0, 1)",
					}								
				},
				{	
					label: 'Новые посетители',
					data: $.parseJSON('<? echo $json_newvisitors; ?>'),
					color: "rgba(0, 255, 0, 1)",
					bars: {
						fillColor: "rgba(0, 255, 0, 1)",
					}								
				}				
			],
			options : {
				series: {
					lines: {
						show: false
					},
					points: {
						show: false
					},
					bars: {
						show: true,
						align: 'left',
						fill: true,
						lineWidth: 0,
						barWidth: (24 * 60 * 60 * 1000)/5,
						zero: false,
						horizontal: false
					},
					shadowSize: 0
				},
				legend: {
					show: true,
					labelBoxBorderColor: 0,
					noColumns: 2,
					position: 'ne',
					margin: [0, 0],
					backgroundColor: null,
					backgroundOpacity: 1,
					sorted: 'ascending'
				},
				xaxis: {
					mode: 'time',
					timeformat: '%d %b',
					minTickSize: [1, "day"],
					monthNames: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"]
				},
				grid: {
					show: true,
					color: '#888888',
					backgroundColor: '#ffffff',
					borderWidth: 1,
					borderColor: '#dddddd',
				}					
			}
		};
		this.init = function () {
			self._objects.start = $(self._getter.start);
			if (!self._objects.start) return false;

			for (var key in self._getter)
				if (key != 'start')
					self._objects[key] = self._objects.start.find(self._getter[key]);

			
			self._objects.placeholder.plot(self._buffer.data, self._buffer.options);
		};
		this.init();
	};
	var fromGraph = function () {
		var self = this;
		self._getter = {
			start: '#fromGraph',
			placeholder: '#fromGraph-chart'
		};
		self._objects = {};
		self._buffer = {
			data : [
				{	
					label: 'Поисковые системы',
					data: $.parseJSON('<? echo $json_engines; ?>'),
					color: "rgba(0, 180, 255, 1)",
					bars: {
						fillColor: "rgba(0, 180, 255, 1)",
					}
				},
				{	
					label: 'Прямые заходы',
					data: $.parseJSON('<? echo $json_forwards; ?>'),
					color: "rgba(255, 255, 0, 1)",
					bars: {
						fillColor: "rgba(255, 255, 0, 1)",
					}
				},
				{	
					label: 'Внутренние переходы',
					data: $.parseJSON('<? echo $json_inbounds; ?>'),
					color: "rgba(255, 0, 0, 1)",
					bars: {
						fillColor: "rgba(255, 0, 0, 1)",
					}
				},
				{	
					label: 'Ссылки на сайтах',
					data: $.parseJSON('<? echo $json_links; ?>'),
					color: "rgba(0, 255, 0, 1)",
					bars: {
						fillColor: "rgba(0, 255, 0, 1)"
					}
				}				
			],
			options : {
				series: {
					lines: {
						show: false
					},
					points: {
						show: false
					},
					bars: {
						show: true,
						align: 'left',
						fill: true,
						lineWidth: 0,
						barWidth: (24 * 60 * 60 * 1000)/5,
						zero: false,
						horizontal: false
					},
					shadowSize: 0
				},
				legend: {
					show: true,
					labelBoxBorderColor: 0,
					noColumns: 2,
					position: 'ne',
					margin: [0, 0],
					backgroundColor: null,
					backgroundOpacity: 1,
					sorted: 'ascending'
				},
				xaxis: {
					mode: 'time',
					timeformat: '%d %b',
					minTickSize: [1, "day"],
					monthNames: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"]
				},
				grid: {
					show: true,
					color: '#888888',
					backgroundColor: '#ffffff',
					borderWidth: 1,
					borderColor: '#dddddd',
				}					
			}
		};
		this.init = function () {
			self._objects.start = $(self._getter.start);
			if (!self._objects.start) return false;

			for (var key in self._getter)
				if (key != 'start')
					self._objects[key] = self._objects.start.find(self._getter[key]);

			self._objects.placeholder.plot(self._buffer.data, self._buffer.options);
		};
		this.init();
	};
	var wordGraph = function (obj, jsonData) {
		var self = this;
		self._getter = {
			placeholder: '.wordGraph-chart'
		};
		self._objects = {};
		self._buffer = {
			data : [
				{	
					label: 'График',
					color: "rgba(255, 0, 0, 0.8)"
				},			
			],
			options : {
				series: {
					lines: {
						show: true,
						lineWidth: 1
					},
					points: {
						show: false,
					},
					shadowSize: 0
				},
				legend: {
					show: false,
				},
				xaxis: {
					show: false,
					mode: 'time',
					timeformat: '%d %b',
					minTickSize: [1, "day"],
					monthNames: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"]
				},
				yaxis: {
					show: true,
					minTickSize: 1,
				},
				grid: {
					show: true,
					color: '#888888',
					backgroundColor: 'rgba(255, 0, 0, 0.2)',
					borderWidth: 1,
					borderColor: 'rgba(255, 0, 0, 0.5)',
				}					
			}
		};
		this.init = function (obj, jsonData) {
			self._objects.start = obj;
			if (!self._objects.start) return false;

			for (var key in self._getter)
				if (key != 'start')
					self._objects[key] = self._objects.start.find(self._getter[key]);
			
			self._buffer.data[0].data = $.parseJSON(jsonData),
			self._objects.placeholder.plot(self._buffer.data, self._buffer.options);
		};
		this.init(obj, jsonData);
	};

	var sEnginesGraph = function (jsonData) {
		var self = this;
		self._getter = {
			start: '#sEnginesGraph',
			placeholder: '#sEnginesGraph-chart'
		};
		self._objects = {};
		self._buffer = {
			data : [
				{}
			],
			options : {
				series: {
					lines: {
						show: true
					},
					points: {
						show: true,
						radius: 1
					}
				},
				legend: {
					show: true,
					labelBoxBorderColor: 0,
					noColumns: 2,
					position: 'ne',
					margin: [0, 0],
					backgroundColor: null,
					backgroundOpacity: 1,
					sorted: 'ascending'
				},
				xaxis: {
					mode: 'time',
					timeformat: '%d %b',
					minTickSize: [1, "day"],
					monthNames: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"]
				},
				grid: {
					show: true,
					color: '#888888',
					backgroundColor: '#ffffff',
					borderWidth: 1,
					borderColor: '#dddddd',
				}				
			}
		};
		this.init = function (jsonData) {
			self._objects.start = $(self._getter.start);
			if (!self._objects.start) return false;

			for (var key in self._getter)
				if (key != 'start')
					self._objects[key] = self._objects.start.find(self._getter[key]);

			self._buffer.data = $.parseJSON(jsonData),
			self._objects.placeholder.plot(self._buffer.data, self._buffer.options);
		};
		this.init(jsonData);
	};					

	$(function () {
		var visitsGraphObj = new visitsGraph();
		var fromGraphObj = new fromGraph();
		var sEnginesGraphObj = new sEnginesGraph('<?=$jsonSEnginesData;?>');
	});
</script>

<script type="text/javascript">
	(function ($) {
		var datePicker = function () {
			var self = this;
			self._buffer = {
				dpOptions : {
					dateFormat: 'dd.mm.yy'
				}					
			};
			this.init = function () {
				$('.datepicker-apply').datepicker(self._buffer.dpOptions);
			};
			this.init();
		};
		$(function () {
			var dpStart = new datePicker();
		});				
	})(jQuery);
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
					<?=$this->element('btn_icon_action', array('plugin' => 'core', 'img'=> 'calendar.png', 'title' => 'За день', 'onclick' => 'document.yesterdayForm.submit()'))?>
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
					<span>с </span>
					<input type="text" value="<?=$dateFromForm;?>" autocomplete="off" name="data[dates][from]" class="datepicker-apply"/>
					<span>по </span>
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
			<script type="text/javascript">
				var wordGraphs = [];
			</script>
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
									wordGraphs.push(obj);
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
		<div id="errorTable" class="row">
			<table>
				<thead>
					<th>Номер</th>
					<th>Код</th>
					<th>Текст ошибки</th>
				</thead>
				<tbody>
			<? foreach ($errors as $key=>$item) : ?>
					<tr class="item<?=$key;?> <? echo $text = ($key == 0) ? 'first' : ''; ?> <? echo $text = (($key != 0) && ($key == count($errors-1))) ? 'last' : ''; ?>">
						<td class="one item1"><? echo ($key+1); ?>.</td>
						<td class="item2"><? echo $item['code']; ?></td>
						<td class="item3 last"><pre><? print_r($item['text']); ?></pre></td>
					</tr>
			<? endforeach; ?>
				</tbody>
			</table>
		</div>	
	</div>
<?
	endif;
?>