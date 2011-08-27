<?php
class shareWidget extends WP_Widget {
	
function shareWidget() {
		$widget_ops = array( 'description' => __('Add social bookmarking links for users to share your blog post') );
		parent::WP_Widget(false, __('Shaken - Share Buttons'), $widget_ops );
		
	} #sharewidget
	
function form($instance) {
		$title = esc_attr($instance['title']);
		
		?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
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
		$instance["title"] = "Tell Your Friends";
		
		$title = $instance['title'];
		?>
        
        
        <?php echo $before_widget . $before_title . $title . $after_title; ?>
        	<div class="share-icons">
		        <?php if(get_option('shaken_tweet_btn_user') && get_option('shaken_tweet_btn_desc')){
					$twitRec = get_option('shaken_tweet_btn_user').':'.get_option('shaken_tweet_btn_desc');
				} 
				else {
					$twitRec = 'sawyerh:Best Designer Alive'; 
				} ?>
				<a href="javascript: void(0)" class="twitter-share iframe" onClick="twitPop('<?php the_permalink(); ?>', '<?php the_title(); ?> - ', '<?php echo $twitRec; ?>')">Twitter</a>
                <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" class="facebook-share" target="_blank">Facebook</a>
                <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="stumble-share" target="_blank">StumbleUpon</a>
                <a href="http://technorati.com/cosmos/search.html?url=<?php the_permalink(); ?>" class="tech-share" target="_blank">Technorati</a>
                <a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="digg-share" target="_blank">Digg</a>
                <a href="http://del.icio.us/post?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="delicious-share" target="_blank">Delicious</a>
                <a href="mailto:EMAIL?body=<?php the_permalink(); ?>" class="email-share" target="_blank">Email</a>
          	</div>
        <?php echo $after_widget; ?>
    <?php
	} // #widget
	
} // class

register_widget('shareWidget');
?>
