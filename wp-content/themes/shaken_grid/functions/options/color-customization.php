<?php

	$option_fields[] = $header_color = THEME_PREFIX . "header_color";
	$option_fields[] = $submenu_bg = THEME_PREFIX . "submenu_bg";
	$option_fields[] = $social_bg = THEME_PREFIX . "social_bg";
	
	$option_fields[] = $logo_title_color = THEME_PREFIX . "logo_title_color";
	$option_fields[] = $logo_tagline_color = THEME_PREFIX . "logo_tagline_color";
	
	$option_fields[] = $nav_text_color = THEME_PREFIX . "nav_text_color";
	$option_fields[] = $nav_special_text_color = THEME_PREFIX . "nav_special_text_color";
	
	$option_fields[] = $bg_color = THEME_PREFIX . "bg_color";
	$option_fields[] = $container_color = THEME_PREFIX . "container_color";
	$option_fields[] = $widget_title_bg = THEME_PREFIX . "widget_title_bg";
	
	$option_fields[] = $headline_color = THEME_PREFIX . "headline_color";
	$option_fields[] = $body_text_color = THEME_PREFIX . "body_text_color";
	$option_fields[] = $small_color = THEME_PREFIX . "small_color";
	$option_fields[] = $widget_title_color = THEME_PREFIX . "widget_title_color";
	
	$option_fields[] = $link_color = THEME_PREFIX . "link_color";
	$option_fields[] = $sidebar_link_color = THEME_PREFIX . "sidebar_link_color";
	
	$option_fields[] = $footer_color = THEME_PREFIX . "footer_color";
	$option_fields[] = $footer_text_color = THEME_PREFIX . "footer_text_color";
	$option_fields[] = $footer_link_color = THEME_PREFIX . "footer_link_color";
	
	$option_fields[] = $custom_styles = THEME_PREFIX . "custom_styles";
?>

<div class="postbox">
	<h3>Header Customizations</h3>
    
	<div class="inside">
    	
        <div class="table">
        	
            <div class="row">
                <p><strong>Backgrounds:</strong></p>
            </div>
        	<?php echo colorPick('Header Background Color', $header_color); ?>
            <?php echo colorPick('Sub-menu Background Color', $submenu_bg); ?>
            <?php echo colorPick('Social Networks Background Color', $social_bg); ?>
            
            <div class="row">
                <p><strong>Logo:</strong></p>
            </div>
            <?php echo colorPick('Title text color', $logo_title_color); ?>
            <?php echo colorPick('Tagline text color', $logo_tagline_color); ?>
            
            <div class="row">
                <p><strong>Menu Items:</strong></p>
            </div>
            <?php echo colorPick('Menu text color', $nav_text_color); ?>
            <?php echo colorPick('Current menu item and menu item hover text color', $nav_special_text_color, '', 'last'); ?>            
        
        </div><!-- #table -->
    
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
        
    </div> <!-- inside -->
</div> <!-- postbox -->

<div class="postbox">
    <h3>Body Customizations</h3>
    
    <div class="inside">	
		<div class="table">
        
        	<div class="row">
                <p><strong>Background:</strong></p>
            </div>
            
            <p><strong>IMPORTANT: To customize the main background, go to <a href="<?php echo get_admin_url(); ?>themes.php?page=custom-background">Appearance &raquo; Background</a></strong></p>
            <?php /*?><?php echo colorPick('Body Background Color', $bg_color); ?><?php */?>
            <?php echo colorPick('Containers Background Color', $container_color, '(Page container, box container, image borders)'); ?>
            <?php echo colorPick('Widget Title Background Color', $widget_title_bg); ?>
                        
            <div class="row">
            	<p><strong>Type Elements:</strong></p>
            </div>
            
            <?php echo colorPick('Headline Color', $headline_color); ?>
            <?php echo colorPick('Body Text Color', $body_text_color, '(paragraphs, lists, blockquotes, etc)'); ?>
            <?php echo colorPick('Small / Unemphasized Text Color', $small_color, '(citations, notes, grid box content). Usually a lower contrast than the body text)'); ?>
            <?php echo colorPick('Widget Title Text Color', $widget_title_color); ?>
            
            <div class="row">
            	<p><strong>Links:</strong></p>
            </div>
            
            <?php echo colorPick('Body Links Color', $link_color); ?>
            <?php echo colorPick('Sidebar Links Color', $sidebar_link_color, '' , 'last'); ?>
			
    		<div class="clearfix"></div>
    	</div>
        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->


<div class="postbox">
	<h3>Footer Customizations</h3>
    
	<div class="inside">
    	
        <div class="table">
        	
            <?php echo colorPick('Footer Background Color', $footer_color); ?>
            <?php echo colorPick('Footer Text Color', $footer_text_color); ?>
            <?php echo colorPick('Footer Links Color', $footer_link_color, '', 'last'); ?>
            
        </div><!-- #table -->
    
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
        
    </div> <!-- inside -->
</div> <!-- postbox -->

<div class="postbox">
	<h3>Custom CSS</h3>
    
	<div class="inside">
    	
        <p>Enter custom CSS in the box below:</p>
    	
    	<p><textarea class="option-area" id="<?php echo $custom_styles; ?>" name="<?php echo $custom_styles; ?>"><?php echo get_option($custom_styles); ?></textarea></p>
        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
        
    </div> <!-- inside -->
</div> <!-- postbox -->