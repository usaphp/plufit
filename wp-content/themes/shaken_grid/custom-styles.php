<?php // ===============================
//				Backgrounds
// ================================ ?>
body{
	background-color:#<?php echo get_option('shaken_bg_color'); ?>;
}
#header{
	background-color:#<?php echo get_option('shaken_header_color'); ?>;
    <?php if(get_option('shaken_bg_color')) { echo 'border:none 0;'; } ?>
}
#footer{
	background-color:#<?php echo get_option('shaken_footer_color'); ?>;
}
.box-content, .page-content, .flickr_badge_image, .jta-tweet-profile-image, .post-thumb{background-color:#<?php echo get_option('shaken_container_color'); ?>}

<?php // ===============================
//				Links
// ================================ ?>

a, a.more-link p{
	color:#<?php echo get_option('shaken_link_color'); ?>;
}
#sidebar a{
	color:#<?php echo get_option('shaken_sidebar_link_color'); ?>;
}
#footer a{
	color:#<?php echo get_option('shaken_footer_link_color'); ?>;
}

<?php // ===============================
//				Text Color
// ================================ ?>
h1, h1 a, h2, h2 a, .box h2 a, #page h2, #full-page h2, h3, h3 a, #page h3, #sidebar h3 a, .widget ul h3 a, .widget .cat-post-item h3 a, .recent-posts h3 a, h4, h5, h6{
	color:#<?php echo get_option('shaken_headline_color'); ?>;
    <?php if(get_option('shaken_headline_color')) { echo 'text-shadow:none;'; } ?> 
}
body, blockquote, #single .post p, #single .post, .entry, .postmetadata, .postmetadata a{
	color:#<?php echo get_option('shaken_body_text_color'); ?>;
}
.post-info p, #archives-page .box .post-info p, .jta-tweet-timestamp, cite, .box, .box blockquote{
	color:#<?php echo get_option('shaken_small_color'); ?>;
}
#footer{
	color:#<?php echo get_option('shaken_footer_text_color'); ?>;
}

<?php // ===============================
//				Header
// ================================ ?>

#logo a, a #logo, #logo a:hover{
	color:#<?php echo get_option('shaken_logo_title_color'); ?>;
}
#site-description{
	color:#<?php echo get_option('shaken_logo_tagline_color'); ?>;
}

.menu li a, .menu li.current-menu-item li a, .menu li.current_page_ancestor li a{
	color:#<?php echo get_option('shaken_nav_text_color'); ?>;
}
.menu li a:hover, .menu li.current-menu-item li a:hover, .menu li.current-menu-item a, .menu li.current_page_ancestor a, .menu li.current_page_ancestor li a:hover, .menu li.current_page_ancestor li.current-menu-item a{
    color:#<?php echo get_option('shaken_nav_special_text_color'); ?>;
}
.menu ul{
	background-color:#<?php echo get_option('shaken_submenu_bg'); ?>;
}

#social-networks{
	background:#<?php echo get_option('shaken_social_bg'); ?>;
    
    <?php if(get_option('shaken_social_bg')) { ?>
    -webkit-box-shadow:none;
	-moz-box-shadow:none;
	-o-box-shadow:none;
	box-shadow:none;
    <?php } ?> 
}

<?php // ===============================
//				Misc.
// ================================ ?>

h3.widget-title{
	background-color:#<?php echo get_option('shaken_widget_title_bg'); ?>;
    color:#<?php echo get_option('shaken_widget_title_color'); ?>;
    <?php if(get_option('shaken_widget_title_bg')) { echo 'text-shadow:none;'; } ?>
}

<?php // ===============================
//			Typography Options
// ================================ ?>

<?php // ======== Headlines ========= ?>

h1, .wf-active h1{
	font-size:<?php echo get_option('shaken_h1'); ?>px;
}
h2, .wf-active h2{
	font-size:<?php echo get_option('shaken_h2'); ?>px;
}
	.wf-active .box h2, .box h2, .wf-active .widget ul h3, .wf-active .widget .cat-post-item h3, .wf-active .recent-posts h3,
    .widget ul h3, .cat-post-item h3, .recent-posts h3{
    	font-size:<?php echo get_option('shaken_small_titles'); ?>px;
    }
h3, .wf-active h3{
	font-size:<?php echo get_option('shaken_h3'); ?>px;
}
	.wf-active h3.widget-title,  h3.widget-title{
    	font-size:<?php echo get_option('shaken_widget_title'); ?>px;
    }
h4, .wf-active h4{
	font-size:<?php echo get_option('shaken_h4'); ?>px;
}
h5, .wf-active h5{
	font-size:<?php echo get_option('shaken_h5'); ?>px;
}
h6, .wf-active h6{
	font-size:<?php echo get_option('shaken_h6'); ?>px;
}

<?php // ======== Content ========= ?>

body, p, ul, ol, .author-name{
	font-size:<?php echo get_option('shaken_body_text'); ?>px;
}
.box blockquote, .box, .box p, .box ul, .box ol, #footer p, cite, .jta-tweet-timestamp, .post-info p, #archives-page .box .post-info p, .comment-date, .reply a{
	font-size:<?php echo get_option('shaken_small_text'); ?>px;
}
blockquote{
	font-size:<?php echo get_option('shaken_blockquote'); ?>px;
}

<?php // ======== Header ========= ?>

.wf-active #logo, #logo{
	font-size:<?php echo get_option('shaken_logo_size'); ?>px;
}

.wf-active #site-description, #site-description{
	font-size:<?php echo get_option('shaken_tagline_size'); ?>px;
}

.wf-active .menu li, .menu li{
	font-size:<?php echo get_option('shaken_nav_size'); ?>px;
}
.menu ul li a{
	font-size:<?php echo get_option('shaken_subnav_size'); ?>px;
}

<?php // ======== Font families ========= ?>
	<?php if(get_option('shaken_header_style') == 'serif') { ?>
        h1, h2, h3, h4, h5, h6, #logo, #logo a, #site-description, .postmetadata, .postmetadata strong{
            font-family:Georgia, "Times New Roman", Times, serif;
        }
        .wf-active .postmetadata{
            font-size:14px;
        }
    <?php } ?>
    
    <?php if(get_option('shaken_content_style') == 'serif') { ?>
        body, input, textarea, .menu ul li a, .menu li a{
            font-family:Georgia, "Times New Roman", Times, serif;
        }
        .wf-active .menu li{
        	font-size:18px;
        }
    <?php } ?>

<?php echo get_option('shaken_custom_styles'); ?>