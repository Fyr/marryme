ddaccordion.init({
	headerclass: "ddn-header",
	contentclass: "ddn-submenu",
	revealtype: "click",
	mouseoverdelay: 0,
	collapseprev: false,
	defaultexpanded: [],
	onemustopen: false,
	animatedefault: false,
	persiststate: false,
	toggleclass: ["", "ddnSelected"], 
	togglehtml: ['prefix', '<img src="/img/arrow.gif" alt="" />', '<img src="/img/arrow_down.gif" alt="" />'], 
	animatespeed: "normal", 
	oninit:function(headers, expandedindices){ 
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ 
		//do nothing
	}
})