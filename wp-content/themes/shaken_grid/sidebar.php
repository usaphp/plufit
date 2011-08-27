<div id="sidebar" class="widget-area">
	<div class="ad_block_sidebar">
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-2966198355915984";
		/* plufit sidebar */
		google_ad_slot = "1243306559";
		google_ad_width = 300;
		google_ad_height = 250;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
	</div>
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

