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
        

		<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?34"></script>
		<!-- VK Widget -->
		<div id="vk_groups"></div>
		<script type="text/javascript">
		VK.Widgets.Group("vk_groups", {mode: 0, width: "310", height: "290"}, 29678436);
		</script>
		<div class="side_share">

		<!-- Put this script tag to the <head> of your page -->

		<script type="text/javascript">
		  VK.init({apiId: 2455824, onlyWidgets: true});
		</script>
		<div class="share_item">
			<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="plufit" data-lang="ru">Твитнуть</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</div>
		<div class="share_item">
			<div id="vk_like"></div>
		</div>
		<div class="clearfix"></div>
		<!-- Put this div tag to the place, where the Like block will be -->
		<script type="text/javascript">
		VK.Widgets.Like("vk_like", {type: "button"});
		</script>
		</div>

    <?php
	} // #widget
	
} // class

register_widget('shareWidget');
?>
