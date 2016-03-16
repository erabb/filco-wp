$(document).ready(function(){

	$(window).scroll(function () {

	    if($(this).scrollTop() > 165 && $(window).width() > 768)
	    {
	        if (!$('.navbar-fixed-top').hasClass('fixed'))
	        {
	            $('.navbar').stop().addClass('fixed').css('top', '-60px').animate(
	                {
	                    'top': '0px'
	                }, 500);
	        }
	    }
	    else
	    {
	        $('.navbar-fixed-top').removeClass('fixed').css('top','-60px');
	    }
	});

});