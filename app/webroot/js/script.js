	$(function() {
if($('.fancybox').length){

(function ($, F) {
    
    // Opening animation - fly from the top
    F.transitions.dropIn = function() {
        var endPos = F._getPosition(true);

        endPos.top = (parseInt(endPos.top, 10) - 200) + 'px';
        endPos.opacity = 0;
        
        F.wrap.css(endPos).show().animate({
            top: '+=200px',
            opacity: 1
        }, {
            duration: F.current.openSpeed,
            complete: F._afterZoomIn
        });
    };

    // Closing animation - fly to the top
    F.transitions.dropOut = function() {
        F.wrap.removeClass('fancybox-opened').animate({
            top: '-=200px',
            opacity: 0
        }, {
            duration: F.current.closeSpeed,
            complete: F._afterZoomOut
        });
    };
    
    // Next gallery item - fly from left side to the center
    F.transitions.slideIn = function() {
        var endPos = F._getPosition(true);

        endPos.left = (parseInt(endPos.left, 10) - 200) + 'px';
        endPos.opacity = 0;
        
        F.wrap.css(endPos).show().animate({
            left: '+=200px',
            opacity: 1
        }, {
            duration: F.current.nextSpeed,
            complete: F._afterZoomIn
        });
    };
    
    // Current gallery item - fly from center to the right
    F.transitions.slideOut = function() {
        F.wrap.removeClass('fancybox-opened').animate({
            left: '-=200px',
            opacity: 0
        }, {
            duration: F.current.prevSpeed,
            complete: function () {
                $(this).trigger('onReset').remove();
            }
        });
    };

}(jQuery, jQuery.fancybox));


for(var i=0;i<$('.fancybox').length;i++){
	$('.fancybox:eq('+i+')').attr('title', 'Изображение '+(i+1)+' из '+$('.fancybox').length)	
}


$('.fancybox').fancybox({
        openMethod : 'dropIn',
        openSpeed : 250,

        closeMethod : 'dropOut',
        closeSpeed : 150,
        
        nextMethod : 'slideIn',
        nextSpeed : 450,
        
        prevMethod : 'slideOut',
        prevSpeed : 450,
  helpers: {
   title: {
    type: 'inside'
   }
  }
});	
}

	$('.item_photo .thumbs a').click(function(e){
		e.preventDefault();
		$('.item_photo .big img').attr({'src':$(this).attr('href')});
		$('.item_photo .big a').attr({'href':$(this).attr('rel')});
	})

	$('.categories_selection .item').click(function(e){
		location.href=$(this).find('a').attr('href');
	})
	
		if($('.header_in .slider').length){
		$('.header_in .slider ul').bxSlider({
		  	displaySlideQty: 1,
	    	moveSlideQty: 1,
			controls:false,
			mode:'fade',
		    pager: false,
			auto: true,
			infiniteLoop: true
		  });		
	}

	$('.pager li a.current').click(function(){return false;})	


	$('.navigation li').each(function(){
		if($(this).find('.drop_m').length){
			$(this).addClass('expandable');
		}
	})


    $('.touch .navigation li.expandable').live('click',function(e){
        e.preventDefault();
        $(this).find('.drop_m').toggle();
    })

    $('.touch .navigation li.expandable li a').live('click',function(e){
        e.stopPropagation();
        //$(this).find('.drop_m').toggle();
    })

    if ('ontouchstart' in document) {
        $('.no-touch').removeClass('no-touch');
    }


});

