<?php
class flickrWidget extends WP_Widget {
	
function flickrWidget() {
		$widget_ops = array( 'description' => __('Add thumbnail images of your recent uploads to Flickr.') );
		parent::WP_Widget(false, __('Shaken - Flickr'), $widget_ops );
		
	} #flickrwidget
	
function form($instance) {
		$title = esc_attr($instance['title']);
		$id = esc_attr($instance['id']);
		$number = esc_attr($instance['number']);
		
		?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr.com/">idGettr</a>):'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos to show:'); ?></label>
        <input size="3" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
	<?php
	}// #form
	
function update($new_instance, $old_instance) {
		// processes widget options to be saved
		return $new_instance;
	} //#update
	
function widget($args, $instance) {
	
		extract( $args );
		
		// outputs the content of the widget
		if( !$instance["title"] )
		$instance["title"] = "Flickr Photos";
		
		$title = $instance['title'];
		
		$id = $instance['id'];
		$number = $instance['number'];

		?>
        
        
        <?php echo $before_widget; echo $before_title; ?>
        <?php if(get_option('shaken_flickr')){ ?> <a href="http://flickr.com/photos/<?php echo get_option('shaken_flickr'); ?>" title="Photos"><img src="<?php echo bloginfo('template_directory')."/images/flickr-ic-16.png"; ?>" height="16" width="16" alt=""/></a><?php } else { ?><img src="<?php echo bloginfo('template_directory')."/images/flickr-ic-16.png"; ?>" height="16" width="16" alt=""/><?php } ?>&nbsp;
        <?php echo $title . $after_title; ?>
        <div class="flickr_photos">
                            
            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>

        </div>
        <div class="clearfix"></div>
        
        <?php echo $after_widget; ?>
    <?php
	} // #widget
	
} // class

register_widget('flickrWidget');
?>
