<?php
	$option_fields[] = $twitter = THEME_PREFIX . "twitter";
	$option_fields[] = $facebook = THEME_PREFIX . "facebook";
	$option_fields[] = $youtube = THEME_PREFIX . "youtube";
	$option_fields[] = $vimeo = THEME_PREFIX . "vimeo";
	$option_fields[] = $flickr = THEME_PREFIX . "flickr";
	$option_fields[] = $delicious = THEME_PREFIX . "delicious";
	$option_fields[] = $email = THEME_PREFIX . "email";
	$option_fields[] = $rss = THEME_PREFIX . "rss";
	
	$option_fields[] = $tweet_btn_user = THEME_PREFIX . "tweet_btn_user";
	$option_fields[] = $tweet_btn_desc = THEME_PREFIX . "tweet_btn_desc";
	
	$images_path = get_bloginfo('template_url') . '/images/';
?>

<div class="postbox">
    <h3>Social Networks</h3>
    
    <div class="inside">
    	<p><img src="<?php echo $images_path; ?>twitter-ic-16.png" width="16" height="16" alt="" /> <strong>Twitter Username</strong></p>
    	<p><input class="option-field" id="<?php echo $twitter; ?>" type="text" name="<?php echo $twitter; ?>" value="<?php echo get_option($twitter); ?>" /></p>
        
        <p><img src="<?php echo $images_path; ?>facebook-ic-16.png" width="16" height="16" alt="" /> <strong>Facebook URL</strong> - Please enter the entire URL to your Facebook page</p>
    	<p><input class="option-field" id="<?php echo $facebook; ?>" type="text" name="<?php echo $facebook; ?>" value="<?php echo get_option($facebook); ?>" /></p>
        
        <p><img src="<?php echo $images_path; ?>youtube.png" width="16" height="16" alt="" /> <strong>YouTube Username</strong></p>
    	<p><input class="option-field" id="<?php echo $youtube; ?>" type="text" name="<?php echo $youtube; ?>" value="<?php echo get_option($youtube); ?>" /></p>
        
        <p><img src="<?php echo $images_path; ?>vimeo.png" width="16" height="16" alt="" /> <strong>Vimeo Username</strong></p>
    	<p><input class="option-field" id="<?php echo $vimeo; ?>" type="text" name="<?php echo $vimeo; ?>" value="<?php echo get_option($vimeo); ?>" /></p>
        
        <p><img src="<?php echo $images_path; ?>flickr-ic-16.png" width="16" height="16" alt="" /> <strong>Flickr Username</strong>- The part that comes after flickr.com/photos/</p>
    	<p><input class="option-field" id="<?php echo $flickr; ?>" type="text" name="<?php echo $flickr; ?>" value="<?php echo get_option($flickr); ?>" /></p>
        
        <p><img src="<?php echo $images_path; ?>delicious-ic-16.png" width="16" height="16" alt="" /> <strong>Delicious Username</strong></p>
    	<p><input class="option-field" id="<?php echo $delicious; ?>" type="text" name="<?php echo $delicious; ?>" value="<?php echo get_option($delicious); ?>" /></p>
        
        <p><img src="<?php echo $images_path; ?>email-ic-16.png" width="16" height="16" alt="" /> <strong>Email Address</strong></p>
        <p><input class="option-field" id="<?php echo $email; ?>" type="text" name="<?php echo $email; ?>" value="<?php echo get_option($email); ?>" /></p>
        
        <p><img src="<?php echo $images_path; ?>rss.png" width="16" height="16" alt="" /> <strong>Custom RSS Feed</strong>- If you have a custom RSS feed setup through a service like Feedburner, enter its URL here:</p>
    	<p><input class="option-field" id="<?php echo $rss; ?>" type="text" name="<?php echo $rss; ?>" value="<?php echo get_option($rss); ?>" /></p>
    	
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->

<div class="postbox">
	<h3>Tweet Button - Who to Follow</h3>
	<div class="inside">
    	<p>When a user shares one of your posts via the Tweet Button, Twitter displays a "who to follow" section. Twitter allows you to define what user is displayed here.
    	<p><strong>Twitter Username to recommend</strong></p>
    	<p><input class="option-field" id="<?php echo $tweet_btn_user; ?>" type="text" name="<?php echo $tweet_btn_user; ?>" value="<?php echo get_option($tweet_btn_user); ?>" /></p>
        
        <p><strong>Short description of the recommended Twitter user</strong> <small>(Ex. Website Name Founder)</small></p>
    	<p><input class="option-field" id="<?php echo $tweet_btn_desc; ?>" type="text" name="<?php echo $tweet_btn_desc; ?>" value="<?php echo get_option($tweet_btn_desc); ?>" /></p>
        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div>
</div>