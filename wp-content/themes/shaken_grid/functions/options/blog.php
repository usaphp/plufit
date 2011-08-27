<?php
	$option_fields[] = $show_all = THEME_PREFIX . "show_all";
	$option_fields[] = $hide_filters = THEME_PREFIX . "hide_filters";
	$option_fields[] = $hide_category_link = THEME_PREFIX . "hide_category_link";
	$option_fields[] = $hide_author = THEME_PREFIX . "hide_author";
?>

<div class="postbox">
    <h3>Blog</h3>
    
    <div class="inside">
    	<p style="font-size:14px"><strong>Gallery Pages</strong></p>
        
    	<p><label><input class="checkbox" id="<?php echo $show_all; ?>" type="checkbox" name="<?php echo $show_all; ?>" value="true"<?php checked(TRUE, (bool) get_option($show_all)); ?> /> <strong>Display all posts on main blog page</strong> <small>(No pagination)</small>
         </label></p>
         
         <p><small><strong>Note:</strong> If you want all posts to be shown on your archive pages as well, go to <a href="<?php echo get_admin_url(); ?>options-reading.php">Settings &rarr; Reading</a> and increase the "Blog pages show at most" option to a number very high.</small></p>
                 
         <p><label><input class="checkbox" id="<?php echo $hide_filters; ?>" type="checkbox" name="<?php echo $hide_filters; ?>" value="true"<?php checked(TRUE, (bool) get_option($hide_filters)); ?> /> <strong>Hide filter options.</strong> <small>(These are only visible on the main blog page and not archives)</small>
         </label></p>
         
         <p><label><input class="checkbox" id="<?php echo $hide_category_link; ?>" type="checkbox" name="<?php echo $hide_category_link; ?>" value="true"<?php checked(TRUE, (bool) get_option($hide_category_link)); ?> /> <strong>Hide category links at bottom of post boxes</strong>. 
         </label></p>
         
        <hr />
        
        <p><strong>Single Post Pages</strong></p>
       	
        <p><label><input class="checkbox" id="<?php echo $hide_author; ?>" type="checkbox" name="<?php echo $hide_author; ?>" value="true"<?php checked(TRUE, (bool) get_option($hide_author)); ?> /> Hide author link</small>
         </label></p>
        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->