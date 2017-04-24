jQuery(document).ready(function($) {

	$(window).scroll(function() {    
	    var scroll = $(window).scrollTop();
	
	    if (scroll >= 20) {
	        $("header").addClass("fixed");
	    } else {
	        $("header").removeClass("fixed");
	    }
	});

});