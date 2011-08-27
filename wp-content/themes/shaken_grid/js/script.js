function twitPop(myURL, myTitle, myRelated) {
	var width  = 650;
	var height = 500;
	var left   = (screen.width  - width)/2;
	var top    = (screen.height - height)/2;
	var params = 'width='+width+', height='+height;
	params += ', top='+top+', left='+left;
	params += ', directories=no';
	params += ', location=no';
	params += ', menubar=no';
	params += ', resizable=no';
	params += ', scrollbars=no';
	params += ', status=no';
	params += ', toolbar=no';
	newwin=window.open("http://twitter.com/share?url="+myURL+"&text="+myTitle+"&related="+myRelated,'Share via Twitter', params);
	if (window.focus) {newwin.focus()}
	return false;
}


jQuery.noConflict();
(function($) {
	
	// =======================================================
	//					Sub-menu Hover
	// =======================================================	
	$('.menu li').find("ul.sub-menu").css('opacity', 0);
	$(".menu li").hover(function() {
		 $(this).find("ul.sub-menu").animate({
			opacity: 1,
			}).show();  
		},
		function(){
			$(this).find("ul.sub-menu").animate({
			opacity: 0
			}, 'fast');
		}
	);
	// =======================================================
	//					Hide Filter Menu
	// =======================================================	
	$('#filtering-nav ul').slideToggle();
	$('a.filter-btn').click(function(){
		$('#filtering-nav ul').slideToggle();
	});
	
	// MouseOver Events
		
	$('.box').hover(function(){
			$('.img-container img', this).fadeTo("fast", 0.65).addClass('box-hover');
			$('.actions', this).fadeTo("fast", 1);
		},
		function(){
			$('img', this).fadeTo("fast", 1).removeClass('box-hover');
			$('.actions', this).fadeTo("fast", 0)
	});
	
	// Sidebar Ads
	$('.shaken_sidebar_ads a:odd img').addClass('last-ad');
	
	// =======================================================
	//						Share Icons
	// =======================================================
	$('.share-container').hide();
	
	$('.share').click(function(){
		var myParent =  $(this).parent();
		$('.share-container', myParent).slideToggle('fast');				   
	});
	
	// ======== Find the spaces and replace with %20 =========
	$(".share-icons a").each(function(){
	  $(this).attr( 'href', encodeURI( $(this).attr("href") ) );
	});
	
	// =======================================================
	//						Color Box
	// =======================================================
	$('.gallery-icon a').attr('rel', 'post-gallery');
	$("a[rel='gallery'], a[rel='lightbox'], .gallery-icon a").colorbox({
		maxWidth: '85%',
		maxHeight: '85%'	
	});
	
	
	$(window).load(function(){
	
		// Grid jQuery plugin: http://desandro.com/resources/jquery-masonry/
		// =======================================================
		//						Masonry Setup
		// =======================================================
		
		speed = 500;
		
		$('#sort').masonry({ 
			columnWidth: 175,
			itemSelector: '.box:not(.invis)',
			animate: true,
			animationOptions: {
				duration: speed,
				queue: false
			}
		});
		
		// =======================================================
		//					Masonry Filtering
		// =======================================================
		$('#filtering-nav li a').click(function(){
			var colorClass = '.' + $(this).attr('class');
			
			if(colorClass=='.all') {
				// show all hidden boxes
				$('#sort').children('.invis')
					.toggleClass('invis').animate({opacity: 1},{ duration: speed });
			} else {    
				// hide visible boxes 
				$('#sort').children().not(colorClass).not('.invis')
					.toggleClass('invis').animate({opacity: 0},{ duration: speed });
				// show hidden boxes
				$('#sort').children(colorClass+'.invis')
					.toggleClass('invis').animate({opacity: 1},{ duration: speed });
			}
			$('#sort').masonry();
		
			return false;
		});
		
	});
})(jQuery);