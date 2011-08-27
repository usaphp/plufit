<?php 
	$option_fields[] = $disable_fontface = THEME_PREFIX . "disable_fontface";
	$option_fields[] = $header_style = THEME_PREFIX . "header_style";
	$option_fields[] = $content_style = THEME_PREFIX . "content_style";
	
	// Font Sizes
	$option_fields[] = $widget_title = THEME_PREFIX . "widget_title";
	$option_fields[] = $small_titles = THEME_PREFIX . "small_titles";
	
	$option_fields[] = $h1 = THEME_PREFIX . "h1";
	$option_fields[] = $h2 = THEME_PREFIX . "h2";
	$option_fields[] = $h3 = THEME_PREFIX . "h3";
	$option_fields[] = $h4 = THEME_PREFIX . "h4";
	$option_fields[] = $h5 = THEME_PREFIX . "h5";
	$option_fields[] = $h6 = THEME_PREFIX . "h6";
	
	$option_fields[] = $body_text = THEME_PREFIX . "body_text";
	$option_fields[] = $small_text = THEME_PREFIX . "small_text";
	$option_fields[] = $blockquotes = THEME_PREFIX . "blockquotes";
	
	$option_fields[] = $logo_size = THEME_PREFIX . "logo_size";
	$option_fields[] = $tagline_size = THEME_PREFIX . "tagline_size";
	$option_fields[] = $nav_size = THEME_PREFIX . "nav_size";
	$option_fields[] = $subnav_size = THEME_PREFIX . "subnav_size";
?>

<div class="postbox">
    <h3>Font Families</h3>
    
    <div class="inside">	

		 <p><label><input class="checkbox" id="<?php echo $disable_fontface; ?>" type="checkbox" name="<?php echo $disable_fontface; ?>" value="true"<?php checked(TRUE, (bool) get_option($disable_fontface)); ?> /> Disable built-in @font-face on headlines</small>
         </label></p>
         <p><small>This theme imports a typeface ("Yanone Kaffeesatz") from <a href="http://code.google.com/webfonts" target="_blank">Google Webfonts</a> to use on the headlines.</small></p>
         <hr />
         
        <p>Headline Style</p>
    
    	<p><select name ="<?php echo $header_style; ?>" id="<?php echo $header_style; ?>">
			<?php $header_style = get_option($header_style); ?>
            <option value="default" <?php if ($header_style=='default') { echo 'selected'; } ?>>Sans Serif (default)</option>
            <option value="serif" <?php if ($header_style=='serif') { echo 'selected'; } ?>>Serif (Georgia)</option>
        </select>
        </p>
        
        <p>Body Content Style</p>
    
    	<p><select name ="<?php echo $content_style; ?>" id="<?php echo $content_style; ?>">
			<?php $content_style = get_option($content_style); ?>
            <option value="default" <?php if ($content_style=='default') { echo 'selected'; } ?>>Sans Serif (default)</option>
            <option value="serif" <?php if ($content_style=='serif') { echo 'selected'; } ?>>Serif (Georgia)</option>
        </select>
        </p>
         
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->

<?php // ===============================================================
	//						Font Sizes
// =============================================================== ?>
<div class="postbox">
    <h3>Font Sizes</h3>
    
    <div class="inside">	
		<div class="table">
        
            <div class="row">
                <p>Please enter only a number. Font sizes will be set in pixels (px).</p>
            </div>
            
        	<div class="row">
                <p><strong>Headings:</strong></p>
            </div>
            
            <?php echo smallInput('Widget Titles', $widget_title); ?>
             <?php echo smallInput('Box &amp; Sidebar Post Titles', $small_titles); ?>
             
             <?php echo smallInput('Header 1', $h1, '(h1/page titles)'); ?>
             <?php echo smallInput('Header 2 (h2)', $h2); ?>
             <?php echo smallInput('Header 3 (h3)', $h3); ?>
             <?php echo smallInput('Header 4 (h4)', $h4); ?>
             <?php echo smallInput('Header 5 (h5)', $h5); ?>
             <?php echo smallInput('Header 6 (h6)', $h6); ?>
             
             <div class="row">
                <p><strong>Content:</strong></p>
            </div>
            
            <?php echo smallInput('Body text', $body_text, '(p, ul, ol)'); ?>
            <?php echo smallInput('Small / Unemphasized Text', $small_text, '(citations, notes, grid box content, and footer text)'); ?>
            <?php echo smallInput('Blockquotes', $blockquotes); ?>
            
            <div class="row">
                <p><strong>Header:</strong></p>
            </div>
            
            <?php echo smallInput('Logo', $logo_size); ?>
            <?php echo smallInput('Tagline', $tagline_size); ?>
            <?php echo smallInput('First-level Menu', $nav_size); ?>
            <?php echo smallInput('Sub-menu', $subnav_size, '', 'last'); ?>
            
			
    		<div class="clearfix"></div>
    	</div>
        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->
