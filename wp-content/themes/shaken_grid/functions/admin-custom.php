<?php

/**
 * @author: Rilwis
 * @url: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 * @version: 2.2
 *
 */

/******************************

Edit meta box settings here

******************************/

$prefix = 'soy_';

$meta_boxes = array();

$meta_boxes[] = array(
	'id' => 'post-options',
	'title' => 'Post Options',
	'pages' => array('post'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Box Size',
			'desc' => 'Select what size box you want your post to be displayed in.',
			'id' => $prefix . 'box_size',
			'type' => 'select', // select box
			'options' => array('Default (310px)', 'Tiny (135px)', 'Medium (485px)', 'Large (660px)') // array of options for select box
		),
		array(
			'name' => 'Display Title?',
			'desc' => 'Should the title of this post be displayed? (Does not apply to single post page)',
			'id' => $prefix . 'show_title',
			'type' => 'select', // select box
			'options' => array('Yes', 'No') // array of options for select box
		),
		array(
			'name' => 'Display Post Content?',
			'desc' => 'Should the post content/excerpt be shown? (Does not apply to single post page)',
			'id' => $prefix . 'show_desc',
			'type' => 'select', // select box
			'options' => array('Yes', 'No') // array of options for select box
		),
		array(
			'name' => 'Video Embed Code',
			'desc' => "Enter your video's embed code in the box above. This video will replace a featured image if you have one set.",
			'id' => $prefix . 'vid',
			'type' => 'textarea', // text area
		),
		array(
			'name' => 'Single Post - Video Embed Code (660px wide)',
			'desc' => "If your original video is smaller than 660px wide, and would like to have a wide version of it when a user is viewing the post's main page, paste the wide version's embed code here",
			'id' => $prefix . 'vid_wide',
			'type' => 'textarea', // text area
		),
		/*array(
			'name' => 'Display Featured Image instead of video?',
			'desc' => 'The featured image will be displayed in all locations (besides the single post page), even if you have a video embed code set.',
			'id' => $prefix . 'hide_vid',
			'type' => 'select', // select box
			'options' => array('No', 'Yes') // array of options for select box
		),*/
		array(
			'name' => 'Display Featured Image instead of video?', // check box
			'desc' => 'The featured image will be displayed in all locations (besides the single post page), even if you have a video embed code set.',
			'id' => $prefix . 'hide_vid',
			'type' => 'checkbox'
		)
	)
);

/*********************************

You should not edit the code below

*********************************/

foreach ($meta_boxes as $meta_box) {
	$my_box = new My_meta_box($meta_box);
}

class My_meta_box {

	protected $_meta_box;

	// create meta box based on given data
	function __construct($meta_box) {
		if (!is_admin()) return;
	
		$this->_meta_box = $meta_box;

		// fix upload bug: http://www.hashbangcode.com/blog/add-enctype-wordpress-post-and-page-forms-471.html
		$current_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);
		if ($current_page == 'page' || $current_page == 'page-new' || $current_page == 'post' || $current_page == 'post-new') {
			add_action('admin_head', array(&$this, 'add_post_enctype'));
		}
		
		add_action('admin_menu', array(&$this, 'add'));

		add_action('save_post', array(&$this, 'save'));
	}
	
	function add_post_enctype() {
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#post").attr("enctype", "multipart/form-data");
			jQuery("#post").attr("encoding", "multipart/form-data");
		});
		</script>';
	}

	/// Add meta box for multiple post types
	function add() {
		foreach ($this->_meta_box['pages'] as $page) {
			add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}

	// Callback function to show fields in meta box
	function show() {
		global $post;

		// Use nonce for verification
		echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
		echo '<table class="form-table">';

		foreach ($this->_meta_box['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
		
			echo '<tr>',
					'<th style="width:20%; font-weight:bold;"><label for="', $field['id'], '">', $field['name'], '</label></th>',
					'<td>';
			switch ($field['type']) {
				case 'text':
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
						'<br />', $field['desc'];
					break;
				case 'textarea':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
						'<br />', $field['desc'];
					break;
				case 'select':
					echo '<select name="', $field['id'], '" id="', $field['id'], '">';
					foreach ($field['options'] as $option) {
						echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
					echo '</select>',
					'<br />', $field['desc'];
					break;
				case 'radio':
					foreach ($field['options'] as $option) {
						echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
					}
					break;
				case 'checkbox':
					echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
					break;
				case 'file':
					echo $meta ? "$meta<br />" : '', '<input type="file" name="', $field['id'], '" id="', $field['id'], '" />',
						'<br />', $field['desc'];
					break;
				case 'image':
					echo $meta ? "<img src=\"$meta\" width=\"150\" height=\"150\" /><br />$meta<br />" : '', '<input type="file" name="', $field['id'], '" id="', $field['id'], '" />',
						'<br />', $field['desc'];
					break;
			}
			echo 	'<td>',
				'</tr>';
		}
	
		echo '</table>';
	}

	// Save data from meta box
	function save($post_id) {
		// verify nonce
		if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		foreach ($this->_meta_box['fields'] as $field) {
			$name = $field['id'];
			
			$old = get_post_meta($post_id, $name, true);
			$new = $_POST[$field['id']];
			
			if ($field['type'] == 'file' || $field['type'] == 'image') {
				$file = wp_handle_upload($_FILES[$name], array('test_form' => false));
				$new = $file['url'];
			}
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $name, $new);
			} elseif ('' == $new && $old && $field['type'] != 'file' && $field['type'] != 'image') {
				delete_post_meta($post_id, $name, $old);
			}
		}
	}
}
?>
