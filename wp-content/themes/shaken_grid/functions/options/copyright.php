<?php
	$option_fields[] = $copyright = THEME_PREFIX . "copyright";
?>

<div class="postbox">
    <h3>Copyright Information</h3>
    
    <div class="inside">
    	<p>Add text after &copy; Copyright</p>
    	<p><input class="option-field" id="<?php echo $copyright; ?>" type="text" name="<?php echo $copyright; ?>" value="<?php echo get_option($copyright); ?>" /></p>
        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->