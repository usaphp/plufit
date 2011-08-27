<?php

add_action( 'after_setup_theme', 'shaken_setup' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override shaken_setup() in a child theme, add your own shaken_setup to your child theme's
 * functions.php file.
 *
 * @since 3.0.0
 */
function shaken_setup() {
	
	// RSS Links
	add_theme_support('automatic-feed-links');
	
	// Add support for gallery post thumbnails 
	add_theme_support( 'post-thumbnails');
		set_post_thumbnail_size( 310, 800);
		// For the premium version:
		add_image_size( 'sidebar', 75, 75, true);
		add_image_size( 'col1', 135, 650);
		add_image_size( 'col3', 485, 800);
		add_image_size( 'col4', 660, 800);
	
	// Add support for nav menus
	add_theme_support( 'nav-menus' );
	
	/* Add your nav menus function to the 'init' action hook. */
	add_action( 'init', 'shaken_register_menus' );
	
	/* Add your sidebars function to the 'widgets_init' action hook. */
	add_action( 'widgets_init', 'shaken_register_sidebars' );
	
	// Add featured images to RSS
	add_filter('pre_get_posts','feedFilter');
}

// smart jquery inclusion
if (!is_admin()) {
	wp_enqueue_script('jquery');
}

function shaken_register_menus(){
	register_nav_menus( array(
			'primary' => __( 'Primary Navigation'),
	));
}

function shaken_register_sidebars(){
	register_sidebar( array (
		'name' => 'Sidebar',
		'id' => 'primary-widget-area',
		'description' => __( 'The main sidebar'),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

// -------------- Add featured images to RSS feed --------------
function feedContentFilter($content) {
	$thumbId = get_post_thumbnail_id();
 
	if($thumbId) {
		$img = wp_get_attachment_image_src($thumbId, 'col3');
		$image = '<img src="'. $img[0] .'" alt="" width="'. $img[1] .'" height="'. $img[2] .'" />';
		echo $image;
	}
 
	return $content;
}

function feedFilter($query) {
	if ($query->is_feed) {
		add_filter('the_content', 'feedContentFilter');
		}
	return $query;
}

//  -------------- Theme Options Pages --------------
$themename = "Shaken Grid";  
$shortname = "soy";

$categories = get_categories('hide_empty=0&orderby=name');  
$wp_cats = array();  
foreach ($categories as $category_list ) {  
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;  
}  
array_unshift($wp_cats, "Choose a category");


// --------------- Theme Options ---------------------------------------------------------------//
$options = array (  
   
array( "name" => $themename." Options",  
    "type" => "title"),  

// --------------- Style Options --------------- //
array( "name" => "Styles",  
    "type" => "section"),  
array( "type" => "open"),  
            
array( "name" => "Custom Favicon",  
    "desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",  
    "id" => $shortname."_favicon",  
    "type" => "text",  
    "std" => get_bloginfo('url') ."/favicon.ico"),
	
array( "name" => "Stylesheet",  
    "desc" => "The color (white or black) of your website",  
    "id" => $shortname."_style",  
	"options" => array("white" => "white","black" => "black"),
    "type" => "select"),
      
array( "type" => "close"), 

// --------------- Social Network Links --------------- //
array( "name" => "General",  
    "type" => "section"),  

array( "type" => "open"),  

array( "name" => "Stat Tracking",  
    "desc" => "Enter the stat tracking code here to add to the end of the HTML",  
    "id" => $shortname."_stats",  
    "type" => "textarea",  
    "std" => ""),   
      
array( "type" => "close")

   
); 
// --------------- End Theme Options ---------------------------------------------------------------//

function mytheme_add_admin() {  
   
global $themename, $shortname, $options;  
   
if ( $_GET['page'] == basename(__FILE__) ) {  
   
    if ( 'save' == $_REQUEST['action'] ) {  
   
        foreach ($options as $value) {  
        update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }  
   
foreach ($options as $value) {  
    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }  
   
    header("Location: admin.php?page=functions.php&saved=true");  
die;  
   
}   
else if( 'reset' == $_REQUEST['action'] ) {  
   
    foreach ($options as $value) {  
        delete_option( $value['id'] ); }  
   
    header("Location: admin.php?page=functions.php&reset=true");  
die;  
   
}  
}  
   
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');  
}  
  
function mytheme_add_init() {  
$file_dir=get_template_directory_uri(); 
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");  
wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");  
} 

function mytheme_admin() {  
   
global $themename, $shortname, $options;  
$i=0;  
   
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';  
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';  
   
?>  
<div class="wrap rm_wrap">  
<h2><?php echo $themename; ?> Settings</h2>  
   
<div class="rm_opts">  
<form method="post">
<?php foreach ($options as $value) {  
switch ( $value['type'] ) {  
   
case "open":  
?>  
   
<?php break;  
   
case "close":  
?>  
   
</div>  
</div>  
<br />  
  
   
<?php break;  
   
case "title":  
?>
<p class="premium-msg">A premium version of Shaken Grid, packed with additional features is available! <br />
<strong><a href="http://shakenandstirredweb.com/themes/shaken-grid" target="_blank">Check it out and purchase today &raquo;</a></strong></p>  
  
   
<?php break;  
   
case 'text':  
?>  
  
<div class="rm_input rm_text">  
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>  
    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />  
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  
   
 </div>  
<?php  
break;  
   
case 'textarea':  
?>  
  
<div class="rm_input rm_textarea">  
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>  
    <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>  
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  
   
 </div>  
    
<?php  
break;  
   
case 'select':  
?>  
  
<div class="rm_input rm_select">  
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>  
      
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">  
<?php foreach ($value['options'] as $option) { ?>  
        <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>  
</select>  
  
    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  
</div>  
<?php  
break;  
   
case "checkbox":  
?>  
  
<div class="rm_input rm_checkbox">  
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>  
      
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>  
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />  
  
  
    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  
 </div>  
<?php break; 

case "section":  
  
$i++; 

?>
  
<div class="rm_section">  
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />  
</span><div class="clearfix"></div></div>  
<div class="rm_options">  
  
   
<?php break;  
   
}  
}  
?>  
   
<input type="hidden" name="action" value="save" />  
</form>  
<form method="post">  
<p class="submit">  
<input name="reset" type="submit" value="Reset" />  
<input type="hidden" name="action" value="reset" />  
</p> 

</form>  
<p><strong>Enjoying this <em>free</em> theme? Please donate so more themes like this one can be released for free.</strong>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="donate-btn">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="JVAP9GC39L2BU">
    <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
</p>
<p><a href="http://shakenandstirredweb.com">A Shaken &amp; Stirred product</a></p>
 </div>   
   
  
<?php  
}  
  
?>
<?php  
add_action('admin_init', 'mytheme_add_init');  
add_action('admin_menu', 'mytheme_add_admin');  
?>
