<?php
class twitterWidget extends WP_Widget {
	
function twitterWidget() {
		$widget_ops = array( 'description' => __('Display your latest Twitter updates.') );
		parent::WP_Widget(false, __('Shaken - Twitter'), $widget_ops );
	} #twitterWidget
	
function form($instance) {
		$title = esc_attr($instance['title']);
		$username = esc_attr($instance['username']);
		$number = esc_attr($instance['number']);
		
		?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
        <p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" /></p>
                
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of tweets to show (default = 5):'); ?></label>
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
		$instance["title"] = "Recent Tweets";
		
		if( !$instance["username"] )
		$instance["username"] = "sawyerh";
		
		if( !$instance["number"] )
		$instance["number"] = "5";
		
		$title = $instance['title'];
		$username = $instance['username'];
		$number = $instance['number'];

		?>
        
        <div class="widget widget_twitter">
			<?php echo $before_title ?>
            <a href="http://twitter.com/<?php echo $username; ?>"><img src="<?php echo bloginfo('template_directory')."/images/twitter-ic-16.png"; ?>" height="16" width="16" alt=""/></a>&nbsp;
            <?php echo $title . $after_title; ?>
            
            <div class="tweets-box">
                <ul id="twitter_update_list">
                <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
   				<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $number; ?>"></script>
                </ul>
            </div>
        </div>
        
    <?php
	} // #widget
	
} // class

register_widget('twitterWidget');
?>
