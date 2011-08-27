<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'shaken' ), max( $paged, $page ) );

?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/colorbox/colorbox.css" />
<!--[if lte IE 8]>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" />
<![endif]-->
<!-- Warchain -->
<?php // Alternate Stylesheet selected in Theme Options 
	if(get_option('shaken_alt_stylesheet') && get_option('shaken_alt_stylesheet') != "default") 
{ ?>
	<link rel='stylesheet' type='text/css' href="<?php bloginfo('template_directory'); ?>/skins/<?php echo get_option('shaken_alt_stylesheet'); ?>.css" media="screen" />
<?php } ?>

<?php // Custom styles set in Theme Options ?>
<link rel='stylesheet' type='text/css' href="<?php bloginfo('url'); ?>/?shaken-custom-content=css" media="screen" />

<?php // Plugins and Scripts  ?>
<?php wp_head(); ?>

<?php // @font-face (Google Web Fonts) 
if(!get_option('shaken_disable_fontface')): ?>
	<script type="text/javascript">
    WebFontConfig = {
    google: { families: [ 'Yanone Kaffeesatz:300', 'Yanone Kaffeesatz:400' ] }
    };
    (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
    })();
    </script>
<?php endif; ?>

<?php // Insert Analytics Code set in Theme Options 
if(get_option('shaken_analytics_code')){ echo get_option('shaken_analytics_code'); } ?>

</head>

<body <?php body_class(); ?>>

<!-- =================================
	Header and Nav
================================= -->
<div id="header">

	<div id="site-info">
    
    	<?php if(get_option('shaken_logo')) { ?>
            <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <img src="<?php echo get_option('shaken_logo'); ?>" alt="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>" title="<?php bloginfo( 'name' ); ?>" id="logo" />
            </a>
        <?php } else { ?>
			<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
            <<?php echo $heading_tag; ?> id="logo">
                <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </<?php echo $heading_tag; ?>>
            <div id="site-description"><?php bloginfo( 'description' ); ?></div>
      	<?php } ?>
        
    </div><!-- #site-info -->
    
    <?php wp_nav_menu( array( 'container_class' => 'header-nav', 'theme_location' => 'header' ) ); ?>
    
    <div id="social-networks">
		<?php if(get_option('shaken_twitter')){ ?>
            <a href="http://twitter.com/<?php echo get_option('shaken_twitter'); ?>" title="Tweets" class="twitter">Twitter</a>
        
		<?php } 
		if(get_option('shaken_facebook')){ ?>
            <a href="<?php echo get_option('shaken_facebook'); ?>" title="Facebook" class="facebook">Facebook</a>
        
		<?php } 
		if(get_option('shaken_youtube')){ ?>
            <a href="http://www.youtube.com/user/<?php echo get_option('shaken_youtube'); ?>" title="YouTube" class="youtube">YouTube</a>
            
        <?php } 
		if(get_option('shaken_vimeo')){ ?>
            <a href="http://www.vimeo.com/<?php echo get_option('shaken_vimeo'); ?>" title="Vimeo" class="vimeo">Vimeo</a>
        
		<?php } 
		if(get_option('shaken_flickr')){ ?>
            <a href="http://www.flickr.com/photos/<?php echo get_option('shaken_flickr'); ?>/" title="Flickr" class="flickr">Flickr</a>
        
		<?php } 
		if(get_option('shaken_delicious')){ ?>
            <a href="http://delicious.com/<?php echo get_option('shaken_delicious'); ?>" title="Bookmarks" class="delicious">Delicious</a>
            
        <?php } 
		if(get_option('shaken_email')){ ?>
            <a href="mailto:<?php echo get_option('shaken_email'); ?>" title="Email" class="email">Email</a>
        
		<?php } ?>
            <a href="<?php if(get_option('shaken_rss')){ echo get_option('shaken_rss'); } else { bloginfo('rss2_url'); }?>" title="Subscribe" class="rss">RSS</a>
            
    </div><!-- #social-networks -->
    
    <div class="clearfix"></div>
</div>