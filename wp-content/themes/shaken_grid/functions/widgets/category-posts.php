<?php
/*
Plugin Name: Category Posts Widget
Plugin URI: http://jameslao.com/2009/12/30/category-posts-widget-3-0/
Description: Adds a widget that can display posts from a single category.
Author: James Lao	
Version: 3.1
Author URI: http://jameslao.com/
*/

// Register thumbnail sizes.
if ( function_exists('add_image_size') )
{
	$sizes = get_option('jlao_cat_post_thumb_sizes');
	if ( $sizes )
	{
		foreach ( $sizes as $id=>$size )
			add_image_size( 'cat_post_thumb_size' . $id, $size[0], $size[1], true );
	}
}

class CategoryPosts extends WP_Widget {

function CategoryPosts() {
	parent::WP_Widget(false, $name='Shaken - Category Posts');
}

/**
 * Displays category posts widget on blog.
 */
function widget($args, $instance) {
	global $post;
	$post_old = $post; // Save the post object.
	
	extract( $args );
	
	$sizes = get_option('jlao_cat_post_thumb_sizes');
	
	// If not title, use the name of the category.
	if( !$instance["title"] ) {
		$category_info = get_category($instance["cat"]);
		$instance["title"] = $category_info->name;
	}
	
	// Get array of post info.
	$cat_posts = new WP_Query("showposts=" . $instance["num"] . "&cat=" . $instance["cat"]);

	// Excerpt length filter
	$new_excerpt_length = create_function('$length', "return " . $instance["excerpt_length"] . ";");
	if ( $instance["excerpt_length"] > 0 )
		add_filter('excerpt_length', $new_excerpt_length);
	
	echo $before_widget;
	
	// Widget title
	echo $before_title;
	if( $instance["title_link"] )
		echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
	else
		echo $instance["title"];
	echo $after_title;
	echo "<ul class='cat-posts'>\n";
	// The Posts
	while ( $cat_posts->have_posts() )
	{
		$cat_posts->the_post();
	?>
		<li class="cat-post-item">
        
        	<div class="post-thumb">
			<?php
				if (
					function_exists('the_post_thumbnail') &&
					current_theme_supports("post-thumbnails") &&
					has_post_thumbnail()
				) :
			?>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('sidebar'); ?></a>
			<?php endif; ?>
            </div>
			
			
			<div class="post-info<?php if ( !$instance['excerpt'] ) {echo ' no-excerpt'; } ?>">
				<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
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

	remove_filter('excerpt_length', $new_excerpt_length);
	
	$post = $post_old; // Restore the post object.
}

/**
 * Form processing... Dead simple.
 */
function update($new_instance, $old_instance) {
	
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
		<label>
			<?php _e( 'Category' ); ?>:
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
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

add_action( 'widgets_init', create_function('', 'return register_widget("CategoryPosts");') );

?>
