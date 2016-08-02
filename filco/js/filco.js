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


	$('.btn-prev').click( function(){
		
		var itemLength = $('.item').length;
		//console.log('itemLength: ' + itemLength);

		var chosenIndex = $('#workModal iframe').attr('chosenIndex');
		//console.log('chosenIndex: ' + chosenIndex);

		if( chosenIndex == 0 ){
			var prev = parseInt(itemLength) - 1;
			$('#workModal iframe').attr('chosenIndex', prev);
			swapModal( prev );
		
		}else{
			$('#workModal iframe').attr('chosenIndex', 0);
			swapModal(0);
		
		}
	});


	$('.btn-next').click( function(){

		var itemLength = $('.item').length;
		//console.log('itemLength: ' + itemLength);

		var chosenIndex = $('#workModal iframe').attr('chosenIndex');
		//console.log('chosenIndex: ' + chosenIndex);

		if( parseInt(chosenIndex) + 1 >= itemLength ){
			
			$('#workModal iframe').attr('chosenIndex', 0);
			swapModal(0);
		
		}else{
			
			$('#workModal iframe').attr('chosenIndex', parseInt(chosenIndex) + 1);
			swapModal(parseInt(chosenIndex) + 1);
		
		}
	});


	$('#workModal').on('show.bs.modal', function (event) {

		var button = $(event.relatedTarget) // Button that triggered the modal

		var title = button.data('title'); // Extract info from data-* attributes
		var descr = button.data('descr');
		var vimeo = button.data('vimeo');

		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this);

		modal.find('.modal-title').html(title);
		modal.find('.modal-footer p').html(descr);
		modal.find('iframe').attr('src', 'https://player.vimeo.com/video/'+vimeo);

		$('#workModal iframe').attr('chosenIndex', $( ".item" ).index( button )  );

		//modal.find('.modal-body input').val(recipient);

	});

	function swapModal(index){

		var indexAdd = parseInt(index) + 1;
		var button = $('.item:nth-child(' + indexAdd + ')');

		var title = button.attr('data-title'); // Extract info from data-* attributes
		var descr = button.data('descr');
		var vimeo = button.data('vimeo');	

		var modal = $('#workModal');

		modal.find('.modal-title').html(title);
		modal.find('.modal-footer p').html(descr);
		modal.find('iframe').attr('src', 'https://player.vimeo.com/video/'+vimeo);	

	}


	$('#contactForm').submit( processForm );

	function processForm( e ){
        
        $.ajax({
            url: 'wp-content/themes/filco/lib/MailHandler.php',
            dataType: 'text',
            type: 'post',
            contentType: 'application/x-www-form-urlencoded',
            data: $(this).serialize(),
            success: function( data, textStatus, jQxhr ){
            	obj = JSON.parse(data);
            	console.log(obj['response']);
            	$('#contactForm').hide();
                $('#responseForm').html( obj['response'] );
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });

        e.preventDefault();
    
    }

	$(function() {
	  $('a[href*="#"]:not([href="#"])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html, body').animate({
	          scrollTop: target.offset().top
	        }, 1000);
	        return false;
	      }
	    }
	  });
	});
	
});