<?php
/*
Plugin Name: Related Posts Widget
Plugin URI: http://jameslao.com/2010/01/01/related-posts-widget-1-0/
Description: Adds a widget that shows a list of related posts.
Author: James Lao	
Version: 1.1
Author URI: http://jameslao.com/
*/

// Register thumbnail sizes.
if ( function_exists('add_image_size') )
{
	$sizes = get_option('jlao_related_post_thumb_sizes');
	if ( $sizes )
	{
		foreach ( $sizes as $id=>$size )
			add_image_size( 'related_post_thumb_size' . $id, $size[0], $size[1], true );
	}
}

class RelatedPosts extends WP_Widget {

function RelatedPosts() {
	$widget_ops = array('classname' => 'rel-post-widget', 'description' => __('List related posts'));
	$this->WP_Widget('related-posts', __('Shaken - Related Posts'), $widget_ops);
}

/**
 * Displays a list of related posts on single post pages.
 */
function widget($args, $instance) {
	// Only show widget if on a post page.
	if ( !is_single() ) return;

	global $post;
	$post_old = $post; // Save the post object.
	
	extract( $args );
	
	if( !$instance["title"] )
		$instance["title"] = "Related Posts";
		
	// Excerpt length filter
	$new_excerpt_length = create_function('$length', "return " . $instance["excerpt_length"] . ";");
	if ( $instance["excerpt_length"] > 0 )
		add_filter('excerpt_length', $new_excerpt_length);
	
	$tags = wp_get_post_tags($post->ID);

	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'showposts'=> $instance['num'], // Number of related posts that will be shown.
			'caller_get_posts'=>1
			);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() )
		{
			echo $before_widget;

			// Widget title
			echo $before_title . $instance["title"] . $after_title;
			
			echo "<ul>\n";
			while ($my_query->have_posts())
			{
				$my_query->the_post();
				?>
				<li class="related-post-item">
                	
                    <div class="post-thumb">
                    <?php
						if (
							function_exists('the_post_thumbnail') && 
							current_theme_supports("post-thumbnails") &&
							has_post_thumbnail()
						) :
					?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('sidebar'); ?>
						</a>
					<?php endif; ?>
                    </div>
                    
                    <div class="post-info<?php if ( !$instance['excerpt'] ) {echo ' no-excerpt'; } ?>">
						<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                        <?php if ( $instance['excerpt'] ) : ?>
							<?php the_excerpt(); ?> 
                        <?php endif; ?>
					</div>
                    
                    <div class="clearfix"></div>
				</li>
				<?php
			}
			echo "</ul>\n";
			
			echo $after_widget;
		}
	}

	remove_filter('excerpt_length', $new_excerpt_length);
	
	$post = $post_old; // Restore the post object.
}

/**
 * Form processing... Dead simple.
 */
function update($new_instance, $old_instance) {
	/**
	 * Save the thumbnail dimensions outside so we can
	 * register the sizes easily. We have to do this
	 * because the sizes must registered beforehand
	 * in order for WP to hard crop images (this in
	 * turn is because WP only hard crops on upload).
	 * The code inside the widget is executed only when
	 * the widget is shown so we register the sizes
	 * outside of the widget class.
	 */
	
    return $new_instance;
}

/**
 * The configuration form.
 */
function form($instance) {
?>
		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id("excerpt"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("excerpt"); ?>" name="<?php echo $this->get_field_name("excerpt"); ?>"<?php checked( (bool) $instance["excerpt"], true ); ?> />
				<?php _e( 'Show post excerpt' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("excerpt_length"); ?>">
				<?php _e( 'Excerpt length (in words):' ); ?>
			</label>
			<input style="text-align: center;" type="text" id="<?php echo $this->get_field_id("excerpt_length"); ?>" name="<?php echo $this->get_field_name("excerpt_length"); ?>" value="<?php echo $instance["excerpt_length"]; ?>" size="3" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php _e('Number of posts to show'); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='3' />
			</label>
		</p>
		
<?php

}

}

add_action( 'widgets_init', create_function('', 'return register_widget("RelatedPosts");') );

?>
