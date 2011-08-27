<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php if (get_option('soy_style') == "black") : ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/black.css" />
<?php endif; ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/colorbox/colorbox.css" />

<?php if (get_option('soy_favicon')) : ?>
	<link rel="shortcut icon" href="<?php echo get_option('soy_favicon'); ?>">
<?php endif; ?>

<!--[if lte IE 8]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" />
<![endif]-->
<!--[if lte IE 7]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" />
<![endif]-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<script type="text/javascript">
  WebFontConfig = {
		custom: { families: ['LeagueGothicRegular'],
		urls: [ '<?php echo get_template_directory_uri(); ?>/font/league/stylesheet.css'] }
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

</head>

<body <?php body_class(); ?>>

<!-- =================================
	Header and Nav
================================= -->
<div id="header">
	<div id="site-info">
        <h1 id="logo"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <h3><?php bloginfo( 'description' ); ?></h3>
    </div>
         <?php wp_nav_menu( array( 'container_class' => 'nav', 'theme_location' => 'primary' ) ); ?>
    <br class="clearfix" />
</div>