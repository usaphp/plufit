jQuery(document).ready(function(){

	function reveal(aID){
		jQuery(".postbox-container").children().hide();
		jQuery(".postbox-container "+aID).fadeIn();
	}
	
	function clickAction(aName){
		jQuery("a.show-"+aName).click(function(){
			reveal("#options-"+ aName);
			jQuery(".options-nav a").removeClass('current-section');
			jQuery(".options-nav a").children().removeClass('current');
			jQuery(this).addClass('current-section');
			jQuery(this).children().addClass('current');
		});
		
	}
	
	// Show only general settings at start
	reveal("#options-general");
	jQuery("a.show-general").addClass('current-section');
	jQuery("a.show-general").children().addClass('current');
	
	// Display on click
	clickAction('general');
	clickAction('styles');
	clickAction('social');
	clickAction('fonts');
	
	jQuery(".fancyme").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});
	
});