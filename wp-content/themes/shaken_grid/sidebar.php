<div id="sidebar" class="widget-area">

	<?php if(is_single()){
		if ( ! dynamic_sidebar( 'post-sidebar' ) ) {}
	} else if(is_page_template('template-unique-sidebar.php')) {
		if ( ! dynamic_sidebar( 'unique-sidebar' ) ) {}
	} else if(is_archive() || is_home()) {
		if ( ! dynamic_sidebar( 'gallery-sidebar' ) ) {}
	} else { ?>

		<?php if ( ! dynamic_sidebar( 'page-sidebar' ) ) : // begin primary widget area ?>
            <h3 class="widget-title"><?php _e( 'Archives'); ?></h3>
            <ul>
                <?php wp_get_archives( 'type=monthly' ); ?>
            </ul>
        
        <?php endif; // end primary widget area ?>
    
    <?php } ?>


</div><!-- #primary .widget-area -->

