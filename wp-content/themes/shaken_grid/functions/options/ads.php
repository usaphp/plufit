<?php
	$option_fields[] = $ads_home = THEME_PREFIX . "ads_home";
	$option_fields[] = $ad_one_img = THEME_PREFIX . "ad_one_img";
	$option_fields[] = $ad_one_link = THEME_PREFIX . "ad_one_link";
	
	$option_fields[] = $ad_two_img = THEME_PREFIX . "ad_two_img";
	$option_fields[] = $ad_two_link = THEME_PREFIX . "ad_two_link";
	
	$option_fields[] = $ad_three_img = THEME_PREFIX . "ad_three_img";
	$option_fields[] = $ad_three_link = THEME_PREFIX . "ad_three_link";
	
	$option_fields[] = $ads_custom = THEME_PREFIX . "ads_custom";
	$option_fields[] = $ads_size = THEME_PREFIX . "ads_size";
?>

<div class="postbox">
    <h3>Advertisements</h3>
    
    <div class="inside">
    	<p>Select the size of your ad box</p>
    
    	<p><select name ="<?php echo $ads_size; ?>" id="<?php echo $ads_size; ?>">
			<?php $ads_size = get_option($ads_size); ?>
            <option value="col1" <?php if ($ads_size=='col1') { echo 'selected'; } ?>>135px (Default)</option>
            <option value="col2" <?php if ($ads_size=='col2') { echo 'selected'; } ?>>310px</option>
            <option value="col3" <?php if ($ads_size=='col3') { echo 'selected'; } ?>>485px</option>
            <option value="col4" <?php if ($ads_size=='col4') { echo 'selected'; } ?>>660px</option>
        </select>
        </p>
        
        <hr />
        
    	<p><label><input class="checkbox" id="<?php echo $ads_home; ?>" type="checkbox" name="<?php echo $ads_home; ?>" value="true"<?php checked(TRUE, (bool) get_option($ads_home)); ?> /> Don't display the ads on the main blog page <small>(typically the homepage)</small>
         </label></p>
         
         <hr />
         
         <p><strong>Ad One</strong></p>
         <?php echo regInput('Image URL', $ad_one_img, '<a href="media-upload.php?post_id=22&amp;type=image&amp;TB_iframe=true&width=640&height=517" id="add_image" class="fancyme" title="Add an Image and then copy the Link URL">(upload)</a>'); ?>
         <?php echo regInput('Link', $ad_one_link); ?>
         
         <p><strong>Ad Two</strong></p>
         <?php echo regInput('Image URL', $ad_two_img, '<a href="media-upload.php?post_id=22&amp;type=image&amp;TB_iframe=true&width=640&height=517" id="add_image" class="fancyme" title="Add an Image and then copy the Link URL">(upload)</a>'); ?>
         <?php echo regInput('Link', $ad_two_link); ?>
         
         <p><strong>Ad Three</strong></p>
         <?php echo regInput('Image URL', $ad_three_img, '<a href="media-upload.php?post_id=22&amp;type=image&amp;TB_iframe=true&width=640&height=517" id="add_image" class="fancyme" title="Add an Image and then copy the Link URL">(upload)</a>'); ?>
         <?php echo regInput('Link', $ad_three_link); ?>
         
         <p><strong>Custom Ad Code</strong></p>
         <p><textarea class="option-area" id="<?php echo $ads_custom; ?>" name="<?php echo $ads_custom; ?>"><?php echo get_option($ads_custom); ?></textarea></p>
                          	
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->