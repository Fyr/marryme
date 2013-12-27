function embedFlashCloud(tagContainerID) {
	mytags = "<tags>" + $('#' + tagContainerID).html() + "</tags>";
	mytags = mytags.replace(/<A/g, '<a')
		.replace(/\/A>/g, "/a>")
		.replace(/(target=_)(\w*)/g, 'target="_$2"')
		.replace(/(class=)(?!")(\w*)/g, 'class="$2"')
		.replace(/(name=)(?!")(\w*)/g, 'name="$2"')
		.replace(/(id=)(?!")(\w*)/g, 'id="$2"');

	mytags = encodeURIComponent(mytags).replace(/!/g, '%21')
		.replace(/'/g, '%27').replace(/\(/g, '%28')
		.replace(/\)/g, '%29').replace(/\*/g, '%2A');

	var rnumber = Math.floor(Math.random()*9999999);
	// 0x2A62C8
	var flashvars = {
		tcolor: "0x470303",
		tcolor2:  "0x470303",
		hicolor:"0x470303",
		tspeed: "110",
		distr: "true",
		mode: "tags",
		tagcloud: mytags
	};

	var params = {
		allowScriptAccess:"always",
		wmode: 'transparent'
	};

	var attributes = {
		id: "flash_cloud"
	};

	var swfUrl = "/tagcloud.swf?r=" + rnumber;
	var swfContainerID = "tags";
	var width = 240;
	var height = 200;
	var flashPlayerVersion = "9.0.0";
	var expressInstallSwfUrl = "expressInstall.swf";
	swfobject.embedSWF(swfUrl, swfContainerID, width, height, flashPlayerVersion, expressInstallSwfUrl, flashvars, params, attributes);
}

$(document).ready(function () {
	// TODO: Detect if browser can display SWF
	if (swfobject.hasFlashPlayerVersion("9")) {
		embedFlashCloud('tags');
	} else {
		$('.tag-cloud').hide();
	}
});