<?php
$functions_path = TEMPLATEPATH . '/functions/';
$widgets_path = TEMPLATEPATH . '/functions/widgets/';

add_custom_background();
add_editor_style();

// --------------  Add support for gallery post thumbnails -------------- 
add_theme_support( 'post-thumbnails');
set_post_thumbnail_size( 310, 800);
add_image_size( 'sidebar', 75, 75, true);
add_image_size( 'col1', 135, 650);
add_image_size( 'col3', 485, 800);
add_image_size( 'col4', 660, 800);

// --------------  Add support for nav menus -------------- 
register_nav_menus( array(
		'header' => __( 'Header Menu'),
) );

// ========================================================================================
//									Default Functions
// ========================================================================================
// smart jquery inclusion
if (!is_admin()) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"), false);
	wp_enqueue_script('jquery');
}

// enable threaded comments
function enable_threaded_comments(){
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
			wp_enqueue_script('comment-reply');
		}
}
add_action('get_header', 'enable_threaded_comments');

// no more jumping for read more link
function no_more_jumping($post) {
	return '<a href="'.get_permalink($post->ID).'" class="read-more">'.'Continue Reading'.'</a>';
}
add_filter('excerpt_more', 'no_more_jumping');

// --------------  Register Menus -------------- 
register_sidebar( array (
	'name' => 'Page Sidebar',
	'id' => 'page-sidebar',
	'description' => __( 'The sidebar on basic pages'),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );
register_sidebar( array (
	'name' => "Unique Sidebar",
	'id' => 'unique-sidebar',
	'description' => __( 'The sidebar on pages with the template of "Unique Sidebar" assigned to them.'),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );
register_sidebar( array (
	'name' => "Blog Post Sidebar",
	'id' => 'post-sidebar',
	'description' => __( 'The sidebar on blog post pages'),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );
register_sidebar( array (
	'name' => 'Gallery Sidebar',
	'id' => 'gallery-sidebar',
	'description' => __( 'The sidebar on the gallery and archive pages'),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

// --------------  Custom Widgets  -------------- 
//require_once ($widgets_path . 'sidebar-query.php');
require_once ($widgets_path . 'flickr.php');
require_once ($widgets_path . 'twitter.php');
require_once ($widgets_path . 'category-posts.php');
require_once ($widgets_path . 'testimonials.php');
require_once ($widgets_path . 'related-posts.php');
require_once ($widgets_path . 'popular-posts.php');
require_once ($widgets_path . 'share.php');
require_once ($widgets_path . 'ads.php');

// --------------  Theme Options Panel -------------- 
require_once ($functions_path . 'admin-options.php');

// --------------  Cusotm Post Fields -------------- 
require_once ($functions_path . 'admin-custom.php');

// --------------  Custom Excerpt Lengths -------------- 
require_once ($functions_path . 'custom-excerpts.php');	

function shaken_head() {
	echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/functions/functions.css" type="text/css" media="all" />';
	echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/functions/scripts/colorpicker/style.css" type="text/css" media="all" />';
	echo '<script src="'.get_bloginfo('template_url').'/functions/scripts/colorpicker/jquery.colorpicker.js" type="text/javascript"></script>';
	echo '<script src="'.get_bloginfo('template_url').'/functions/scripts/colorpicker/jquery.eye.js" type="text/javascript"></script>';
}
add_action('admin_head','shaken_head');

// -------------- Custom Styles --------------
add_action( 'parse_request', 'shaken_custom_styles' );
function shaken_custom_styles($wp) {
    if (
        !empty( $_GET['shaken-custom-content'] )
        && $_GET['shaken-custom-content'] == 'css'
    ) {
        header( 'Content-Type: text/css' );
        require dirname( __FILE__ ) . '/custom-styles.php';
        exit;
    }
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
add_filter('pre_get_posts','feedFilter');
 
// -------------- Custom Comment Structure -------------- 
if ( ! function_exists( 'shaken_comment' ) ) :
function shaken_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>">
        	<div class="author-avatar"><?php echo get_avatar( $comment, 70 ); ?></div>
            
            <div class="comment-meta">
                <span class="author-name"><?php printf( __( '%s', 'shaken' ), sprintf( '%s', get_comment_author_link() ) ); ?></span>
                <span class="comment-date"><?php printf( __( '%1$s at %2$s', 'shaken' ), get_comment_date('M j, Y'),  get_comment_time() ); ?><?php edit_comment_link( __( '(Edit)', 'shaken' ), ' ' );?></span>
            </div><!-- .comment-meta -->
        
			<?php if ( $comment->comment_approved == '0' ) : ?>
                <em><?php _e( 'Your comment is awaiting moderation.', 'shaken' ); ?></em>
                <br />
            <?php endif; ?>
			
			<?php comment_text(); ?>
            
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
		</div><!-- #comment-ID -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'shaken' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'shaken'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
} endif; 
?>