<?php class popularPostsWidget extends WP_Widget {

   function popularPostsWidget() {
	   $widget_ops = array('description' => 'Display a list of your posts ordered by popularity (comment count)' );
       parent::WP_Widget(false, __('Shaken - Popular Posts'),$widget_ops);      
   }
   
   function widget($args, $instance) {  
   
   	global $post;
	$post_old = $post; // Save the post object.
   
    extract( $args );
   	$title = $instance['title'];
	$how_many = $instance['how_many'];
	?>

        <div class="widget popular-posts-widget">
        
            <?php echo $before_title . $title . $after_title; ?>
            <ul>
                <?php $popularQuery = new WP_Query('orderby=comment_count&posts_per_page='.$how_many);
				if ( $popularQuery->have_posts() ) : while ( $popularQuery->have_posts() ) : $popularQuery->the_post(); ?>
                
					<li> <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; endif; ?>
            </ul>
        
        </div>
   	
	<?php
	
	$post = $post_old; // Restore the post object.
	
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);
	   $how_many = esc_attr($instance['how_many']);
	   
       ?>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('how_many'); ?>">How many posts should be shown?</label>
	       <input type="text" name="<?php echo $this->get_field_name('how_many'); ?>"  value="<?php echo $how_many; ?>" class="widefat" id="<?php echo $this->get_field_id('how_many'); ?>" />
       </p>
       
      <?php
   }
   
} 
register_widget('popularPostsWidget');

?>