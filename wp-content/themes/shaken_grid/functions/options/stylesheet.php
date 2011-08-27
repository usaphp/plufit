<?php
	$option_fields[] = $alt_stylesheet = THEME_PREFIX . "alt_stylesheet";
?>

<div class="postbox">
    <h3>Theme Styles</h3>
    
    <div class="inside">
    	<p>Select which color scheme you'd like to use.</p>
    
    	<p><select name ="<?php echo $alt_stylesheet; ?>" id="<?php echo $alt_stylesheet; ?>">
			<?php $alt_stylesheet = get_option($alt_stylesheet); ?>
            <option value="default" <?php if ($alt_stylesheet=='default') { echo 'selected'; } ?>>Default</option>
            <option value="bumble-bee" <?php if ($alt_stylesheet=='bumble-bee') { echo 'selected'; } ?>>Bumble Bee</option>
            <option value="mint" <?php if ($alt_stylesheet=='mint') { echo 'selected'; } ?>>Mint</option>
            <option value="fancy" <?php if ($alt_stylesheet=='fancy') { echo 'selected'; } ?>>Fancy</option>
            <option value="silver" <?php if ($alt_stylesheet=='silver') { echo 'selected'; } ?>>Silver</option>
            <option value="blue" <?php if ($alt_stylesheet=='blue') { echo 'selected'; } ?>>Blue</option>
            <option value="rose" <?php if ($alt_stylesheet=='rose') { echo 'selected'; } ?>>Rose</option>
            <option value="dark" <?php if ($alt_stylesheet=='dark') { echo 'selected'; } ?>>Dark</option>
            <option value="custom" <?php if ($alt_stylesheet=='custom') { echo 'selected'; } ?>>Custom Stylesheet <small>(wp-content/themes/shaken-grid-premium/skins/custom.css)</small></option>
        </select>
        </p>
    	        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->