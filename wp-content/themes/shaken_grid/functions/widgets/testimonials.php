<?php class testimonialWidget extends WP_Widget {

   function testimonialWidget() {
	   $widget_ops = array('description' => 'Display a testimonial.' );
       parent::WP_Widget(false, __('Shaken - Testimonial'),$widget_ops);      
   }
   
   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
    $text = $instance['text']; 
	$citation = $instance['citation'];
	$unique_id = $args['widget_id'];
	?>

        <div id="testimonial_<?php echo $unique_id; ?>" class="testimonial-widget widget">
        
            <?php echo $before_title . $title . $after_title; ?>
            <blockquote>
                <p><?php echo $text; ?></p>
            </blockquote>
            <cite>&mdash; <?php echo $citation; ?></cite> 
        
        </div>
   		
	<?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);
       $text = esc_attr($instance['text']);
	   $citation = esc_attr($instance['citation']);
       ?>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:'); ?></label>
			<textarea name="<?php echo $this->get_field_name('text'); ?>" class="widefat" id="<?php echo $this->get_field_id('text'); ?>"><?php echo $text; ?></textarea>
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('citation'); ?>"><?php _e('Citation:'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('citation'); ?>"  value="<?php echo $citation; ?>" class="widefat" id="<?php echo $this->get_field_id('citation'); ?>" />

       </p>
      <?php
   }
   
} 
register_widget('testimonialWidget');

?>