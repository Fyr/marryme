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