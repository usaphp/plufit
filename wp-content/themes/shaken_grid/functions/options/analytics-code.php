<?php
	$option_fields[] = $analytics_code = THEME_PREFIX . "analytics_code";
?>

<div class="postbox">
    <h3>Stat Tracking Code</h3>
    
    <div class="inside">
    	<p>Paste your Stat Tracking code below. <small>Will be added immediately before the closing &lt;/head&gt; tag</small></p>
    	
    	<p><textarea class="option-area" id="<?php echo $analytics_code; ?>" name="<?php echo $analytics_code; ?>"><?php echo get_option($analytics_code); ?></textarea></p>
    	
    	<p class="submit">
    		<input type="submit" class="button" value="Save Changes" />
    	</p>
    </div> <!-- inside -->
</div> <!-- postbox -->