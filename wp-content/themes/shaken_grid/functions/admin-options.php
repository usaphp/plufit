<?php

define("THEME_PREFIX", "shaken_");

// Theme Version
add_option("shaken_version", "1.3");

// The Admin Page
function soy_shaken_admin() {
	$option_fields = array();
	echo '<script src="'.get_bloginfo('template_url').'/functions/scripts/fancybox/jquery.fancybox-1.3.1.pack.js" type="text/javascript"></script>';
	echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/functions/scripts/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="all" />';
	echo '<script src="'.get_bloginfo('template_url').'/functions/scripts/theme-options-scripts.js" type="text/javascript"></script>';
	if ( $_GET['updated'] ) echo '<div id="message" class="updated fade"><p>Theme Options Saved.</p></div>';
?>

<?php
	// =================================================================
	//						Functions for input areas
	// =================================================================
	
	// Color picker
	function colorPick($title, $name, $desc = '', $last = 'notLast'){
			
			return '<div class="row '.$last.'">
    			<div class="option">
                	<label class="config_level">
						<label for="'.$name.'">'.$title.' <small>'.$desc.'</small></label>
					</label>
				</div>
                
                <div class="option-select">	
					<script language="javascript">
					(function($){
						var initLayout = function() {
							$("#'.$name.'").ColorPicker({
								onSubmit: function(hsb, hex, rgb, el) {
									$(el).val(hex);
									$(el).ColorPickerHide();
								},
								onBeforeShow: function () {
									$(this).ColorPickerSetColor(this.value);
								}
							})
							.bind("keyup", function(){
								$(this).ColorPickerSetColor(this.value);
							});
						};
						
						EYE.register(initLayout, "init");
					})(jQuery)
					</script>
					
					#<input class="option-field-table" id="'.$name.'" type="text" name="'.$name.'" value="'.get_option($name).'" />
				</div>
    		</div><!-- #row -->';
            
	}
	
	// Tabel small input
	function smallInput($title, $name, $desc = '', $last = 'notLast'){
			
			return '<div class="row '.$last.'">
    			<div class="option">
                	<label class="config_level" for="'.$name.'">
						<label>'.$title.' <small>'.$desc.'</small></label>
					</label>
				</div>
                
                <div class="option-select">	
					<input class="option-field-table" id="'.$name.'" type="text" name="'.$name.'" value="'.get_option($name).'" />px
				</div>
    		</div><!-- #row -->';
	}
	
	function regInput($title, $name, $desc = ''){
		return '
		<p>'.$title.' <small>'.$desc.'</small></p>
    	<p><input class="option-field" id="'.$name.'" type="text" name="'.$name.'" value="'.get_option($name).'" /></p>
		';
	}
?>

<div class="wrap">
    <div id="icon-options-general" class="icon32"><br/></div>

    <h2>Shaken Grid Theme Options</h2>

    <div class="metabox-holder">
    
    	
    	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
    
        <div id="theme-options">
        
        	<div class="options-header">
            	<ul>
                    <li><a href="http://themes.sawyerhollenshead.com/shaken-grid/updates/">Updates</a></li>
                    <li><a href="http://themes.sawyerhollenshead.com/">Support</a></li>
                    <li><a href="http://themes.sawyerhollenshead.com/shaken-grid/documentation/">Documentation</a></li>
                </ul>
        		<p class="theme-version"><strong>Version:</strong> 1.3</p>
        	</div>
        	<div class="options-nav">
            	<ul>
                	<li><a href="#" class="show-general"><span>General Settings<br />
						<div class="desc">Blog, Copyright, Stats</div></span>
					</a></li>
                    <li><a href="#" class="show-social"><span>Social Networks<br />
						<div class="desc">Twitter, Flickr, &amp; more</div></span>
                    </a></li>
                    <li><a href="#" class="show-styles"><span>Look and Feel<br />
						<div class="desc">Logo, Color, &amp; Skins</div></span>
                    </a></li>
                    <li><a href="#" class="show-fonts"><span>Typography<br />
						<div class="desc">Font-families and sizes</div></span>
                    </a></li>
                </ul>
            </div>
	        <div class="postbox-container">
            	<div id="options-general">
                	<?php 
					include("options/blog.php");
					include("options/ads.php");
					include("options/copyright.php");
					include("options/analytics-code.php"); ?>
                </div>
                           
            	<div id="options-social">
                	 <?php include("options/social-networks.php"); ?>
                </div>
                
                <div id="options-styles">
                	<?php 
					include("options/logo-customization.php");
					include("options/stylesheet.php");
					include("options/color-customization.php"); 
					?>
                </div>
                
                <div id="options-fonts">
                	 <?php include("options/typography.php"); ?>
                </div>
                
	        </div> <!-- postbox-container -->
        </div> <!-- theme-options -->
        
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="<?php echo implode(",", $option_fields); ?>" />
        </form>
    </div> <!-- metabox-holder -->
</div> <!-- wrap -->

<?php
}

add_action('admin_menu', "soy_shaken_admin_init");

// Register Admin
function soy_shaken_admin_init()
{
	//add_theme_page( "Theme Options", "Theme Options", 8, __FILE__, 'soy_shaken_admin');
	add_menu_page("Theme Options", "Theme Options", 'edit_theme_options', basename(__FILE__), 'soy_shaken_admin', get_bloginfo('template_url').'/functions/menu-ic.png',35);
}