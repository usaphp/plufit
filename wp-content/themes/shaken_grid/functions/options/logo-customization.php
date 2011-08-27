<?php
	$option_fields[] = $logo = THEME_PREFIX . "logo";
	$option_fields[] = $logo_img = THEME_PREFIX . "logo_img";
?>

<div class="postbox">
    <h3>Logo Customization Options</h3>
    
    <div class="inside">
    	<p><a href="media-upload.php?post_id=22&amp;type=image&amp;TB_iframe=true&width=640&height=517" id="add_image" class="fancyme" title="Add an Image and then copy the Link URL">Upload</a> a custom logo, then enter the "Link URL" below.</p>
    	<p><input class="option-field" id="<?php echo $logo; ?>" type="text" name="<?php echo $logo; ?>" value="<?php echo get_option($logo); ?>" /></p>
        
        
    	
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->