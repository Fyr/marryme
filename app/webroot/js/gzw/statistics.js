var App = {
	wordGraphObjs : [],
	visitsGraphObj : [],
	fromGraphObj : [],
	sEnginesGraphObj : [],
	dpObjs : []
}

var obj = {}

var visitsGraph = function (jsonArr) {
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
				data: null,
				color: "rgba(0, 180, 255, 1)",
				bars: {
					fillColor: "rgba(0, 180, 255, 1)",
				}							
			},
			{	
				label: 'Визиты',
				data: null,
				color: "rgba(255, 255, 0, 1)",
				bars: {
					fillColor: "rgba(255, 255, 0, 1)",
				}							
			},
			{	
				label: 'Посетители',
				data: null,
				color: "rgba(255, 0, 0, 1)",
				bars: {
					fillColor: "rgba(255, 0, 0, 1)",
				}								
			},
			{	
				label: 'Новые посетители',
				data: null,
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
	this.init = function (jsonArr) {
		self._objects.start = $(self._getter.start);
		if (!self._objects.start) return false;

		for (var key in self._getter)
			if (key != 'start')
				self._objects[key] = self._objects.start.find(self._getter[key]);
		
		jsonArr = $.parseJSON(jsonArr);
		
		self._buffer.data[0].data = jsonArr[0];
		self._buffer.data[1].data = jsonArr[1];
		self._buffer.data[2].data = jsonArr[2];
		self._buffer.data[3].data = jsonArr[3];
		
		self._objects.placeholder.plot(self._buffer.data, self._buffer.options);
	};
	this.init(jsonArr);
};
var fromGraph = function (jsonArr) {
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
				data: null,
				color: "rgba(0, 180, 255, 1)",
				bars: {
					fillColor: "rgba(0, 180, 255, 1)",
				}
			},
			{	
				label: 'Прямые заходы',
				data: null,
				color: "rgba(255, 255, 0, 1)",
				bars: {
					fillColor: "rgba(255, 255, 0, 1)",
				}
			},
			{	
				label: 'Внутренние переходы',
				data: null,
				color: "rgba(255, 0, 0, 1)",
				bars: {
					fillColor: "rgba(255, 0, 0, 1)",
				}
			},
			{	
				label: 'Ссылки на сайтах',
				data: null,
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
	this.init = function (jsonArr) {
		self._objects.start = $(self._getter.start);
		if (!self._objects.start) return false;

		for (var key in self._getter)
			if (key != 'start')
				self._objects[key] = self._objects.start.find(self._getter[key]);
		
		jsonArr = $.parseJSON(jsonArr);
		
		self._buffer.data[0].data = jsonArr[0];
		self._buffer.data[1].data = jsonArr[1];
		self._buffer.data[2].data = jsonArr[2];
		self._buffer.data[3].data = jsonArr[3];				

		self._objects.placeholder.plot(self._buffer.data, self._buffer.options);
	};
	this.init(jsonArr);
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