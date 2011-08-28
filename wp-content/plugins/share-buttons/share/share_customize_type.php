<?php
    
	global $post;
	$locale = substr(get_locale(),0,2);
	$title = esc_js($post->post_title);
	$url = get_permalink($post->ID);
	$via = get_option('twitter_via');
        $vk_text = __('Share',$this->plugin_domain);
	$customize_type = get_option('opt_customize_type');
        $mailru		="";
	$odkl		="";
	$twitter	="";
	$facebook	="";
	$vkontakte	="";
	$vk_type	="";
	$livejournal	="";
	$googlebuzz	="";


	if($via!='') { $via_new='&via='.$via; } else { $via_new = ''; }

	if($customize_type=='original_count') {

		/* Mail.ru */
		$mailru .= "<div class='mailru-button'><a rel='nofollow' title='".__('Post to MyWorld', $this->plugin_domain)."' class='mrc__share' type='button_count' href='http://connect.mail.ru/share?share_url=$url'>".__('In My World',$this->plugin_domain)."</a></div>";

		/* Odnoklassniki */
		$odkl .= "<div class='odkl-button'><a rel='nofollow' class='odkl-klass-stat' href='".$url."' onclick='ODKL.Share(this);return false;' ><span>0</span></a></div>";

		/* Tweet */
		$twitter .= "<div class='twitter-horizontal'><a rel='nofollow' title='".__('Post to Twitter', $this->plugin_domain)."' href='http://twitter.com/share' data-url='".$url."' data-text='".$title."' class='twitter-share-button' data-count='horizontal' data-via='".$via."'>Tweet</a></div>";

		/* Facebook */
		$facebook .= "<div class=\"fb-share-button\"><a rel='nofollow' title='".__('Post to Facebook', $this->plugin_domain)."' name=\"fb_share\" type=\"button_count\" share_url='".$url."'>".__('Share to FB',$this->plugin_domain)."</a></div>";

		$livejournal .= "<div class='live-journal'>";
		$livejournal .= "<a rel='nofollow' title='".__('Post to LiveJournal', $this->plugin_domain)."' href=\"http://www.livejournal.com/update.bml?event=".$url."&subject=".$title."\" target=\"_blank\" name =\"livejournal\"/>";
		$livejournal .= "<img src='".$this->plugin_url."images/social/original_count/livejournal.png' /></a></div>";


		$googlebuzz .= "<div class='google-buzz'>";
		$googlebuzz .= "<a rel='nofollow' title='".__('Post to Google Buzz', $this->plugin_domain)."' class=\"google-buzz-button\" href=\"http://www.google.com/buzz/post\" data-button-style=\"small-count\" data-locale='".$locale."'></a></div>";

		/* Vkontakte */
		$vk_type .= "button";
		$vkontakte .= "<div class=\"vk-button\">\r\n";


	} else if($customize_type=='original') {

		/* Mail.ru */
		$mailru .= "<div class='mailru-button-nocount'><a rel='nofollow' title='".__('Post to MyWorld', $this->plugin_domain)."' class='mrc__share' type='button' href='http://connect.mail.ru/share?share_url=$url'>".__('In My World',$this->plugin_domain)."</a></div>";

		/* Odnoklassniki */
		$odkl .= "<div class='odkl-button-count'><a class='odkl-klass' href='".$url."' onclick='ODKL.Share(this);return false;' >Класс!</a></div>";

		/* Tweet */
		$twitter .= "<div class='twitter-none'><a rel='nofollow' title='".__('Post to Twitter', $this->plugin_domain)."' href='http://twitter.com/share' data-url='".$url."' data-text='".$title."' class='twitter-share-button' data-count='none' data-via='".$via."'>Tweet</a></div>";

		/* Facebook */
		$facebook .= "<div class=\"fb-share-button\"><a rel='nofollow' title='".__('Post to Facebook', $this->plugin_domain)."' name=\"fb_share\" type=\"button\" share_url=\"".$url."\">".__('Share to FB',$this->plugin_domain)."</a></div>";

		$livejournal .= "<div class='live-journal'>";
		$livejournal .= "<a rel='nofollow' title='".__('Post to LiveJournal', $this->plugin_domain)."' href=\"http://www.livejournal.com/update.bml?event=".$url."&subject=".$title."\" target=\"_blank\" name =\"livejournal\"/>";
		$livejournal .= "<img src='".$this->plugin_url."images/social/original/livejournal.png' /></a></div>";


		$googlebuzz .= "<div class='google-buzz'>";
		$googlebuzz .= "<a rel='nofollow' title='".__('Post to Google Buzz', $this->plugin_domain)."' class=\"google-buzz-button\" href=\"http://www.google.com/buzz/post\" data-button-style=\"small-button\" data-locale='".$locale."'></a></div>";

		/* Vkontakte */
		$vk_type .= "button_nocount";
		$vkontakte .= "<div class=\"vk-button\">\r\n";

	} else if($customize_type=='classic') {

		/* Mail.ru */
		$mailru .= "<div class='mailru-myicon'>";
		$mailru .= "<a rel='nofollow' title='".__('Post to MyWorld', $this->plugin_domain)."' href=\"#mailru\" name=\"mailru\" onclick=\"new_window('http://connect.mail.ru/share?share_url=$url');\">";
		$mailru .= "<img src='".$this->plugin_url."images/social/classic/mailru.png' /></a></div>";

		/* Odnoklassniki */
                $odkl .= "<div class='odkl-myicon'>";
		$odkl .= "<a rel='nofollow' title='".__('Post to Odnoklassniki', $this->plugin_domain)."' href=\"#odnoklassniki\" name=\"odnoklassniki\" onclick=\"new_window('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=$url');\">";
		$odkl .= "<img src='".$this->plugin_url."images/social/classic/odnoklassniki.png' /></a></div>";

		/* Tweet */
		$twitter .= "<div class='twitter-myicon'>";
		$twitter .= "<a rel='nofollow' title='".__('Post to Twitter', $this->plugin_domain)."' href=\"#twitter\" name=\"twitter\" onclick=\"new_window('http://twitter.com/share?&text=$title%20-%20&url=$url$via_new');\">";
		$twitter .= "<img src='".$this->plugin_url."images/social/classic/twitter.png' /></a></div>";

		/* Facebook */
		$facebook .= "<div class='fb-myicon'>";
		$facebook .= "<a rel='nofollow' title='".__('Post to Facebook', $this->plugin_domain)."' href=\"#facebook\" name=\"facebook\" onclick=\"new_window('http://www.facebook.com/sharer.php?u=$url');\">";
		$facebook .= "<img src='".$this->plugin_url."images/social/classic/facebook.png' /></a></div>";

		$livejournal .= "<div class='live-journal'>";
		$livejournal .= "<a rel='nofollow' title='".__('Post to LiveJournal', $this->plugin_domain)."' href=\"http://www.livejournal.com/update.bml?event=".$url."&subject=".$title."\" target=\"_blank\" name =\"livejournal\"/>";
		$livejournal .= "<img src='".$this->plugin_url."images/social/classic/livejournal.png' /></a></div>";


		$googlebuzz .= "<div class='google-buzz'>";
		$googlebuzz .= "<a rel='nofollow' title='".__('Post to Google Buzz', $this->plugin_domain)."' href=\"http://www.google.com/buzz/post?message=".$title."&url=".$url."\">";
		$googlebuzz .= "<img src='".$this->plugin_url."images/social/classic/googlebuzz.png' /></a></div>";

		/* Vkontakte */
		$vk_type .= "custom";
		$vk_text = '<img src="'.$this->plugin_url.'images/social/classic/vkontakte.png" / title="Vkontakte">';
		$vkontakte .= "<div class='vk-myicon'>";


	} else if($customize_type=='soft_rect') {

		/* Mail.ru */
		$mailru .= "<div class='mailru-myicon'>";
		$mailru .= "<a rel='nofollow' title='".__('Post to MyWorld', $this->plugin_domain)."' href=\"#mailru\" name=\"mailru\" onclick=\"new_window('http://connect.mail.ru/share?share_url=$url');\">";
		$mailru .= "<img src='".$this->plugin_url."images/social/soft_rect/mailru.png' /></a></div>";

		/* Odnoklassniki */
                $odkl .= "<div class='odkl-myicon'>";
		$odkl .= "<a rel='nofollow' title='".__('Post to Odnoklassniki', $this->plugin_domain)."' href=\"#odnoklassniki\" name=\"odnoklassniki\" onclick=\"new_window('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=$url');\">";
		$odkl .= "<img src='".$this->plugin_url."images/social/soft_rect/odnoklassniki.png' /></a></div>";

		/* Tweet */
		$twitter .= "<div class='twitter-myicon'>";
		$twitter .= "<a rel='nofollow' title='".__('Post to Twitter', $this->plugin_domain)."' href=\"#twitter\" name=\"twitter\" onclick=\"new_window('http://twitter.com/share?&text=$title%20-%20&url=$url$via_new');\">";
		$twitter .= "<img src='".$this->plugin_url."images/social/soft_rect/twitter.png' /></a></div>";

		/* Facebook */
		$facebook .= "<div class='fb-myicon'>";
		$facebook .= "<a rel='nofollow' title='".__('Post to Facebook', $this->plugin_domain)."' href=\"#facebook\" name=\"facebook\" onclick=\"new_window('http://www.facebook.com/sharer.php?u=$url');\">";
		$facebook .= "<img src='".$this->plugin_url."images/social/soft_rect/facebook.png' /></a></div>";

		$livejournal .= "<div class='live-journal'>";
		$livejournal .= "<a rel='nofollow' title='".__('Post to LiveJournal', $this->plugin_domain)."' href=\"http://www.livejournal.com/update.bml?event=".$url."&subject=".$title."\" target=\"_blank\" name =\"livejournal\"/>";
		$livejournal .= "<img src='".$this->plugin_url."images/social/soft_rect/livejournal.png' /></a></div>";


		$googlebuzz .= "<div class='google-buzz'>";
		$googlebuzz .= "<a rel='nofollow' title='".__('Post to Google Buzz', $this->plugin_domain)."' href=\"http://www.google.com/buzz/post?message=".$title."&url=".$url."\">";
		$googlebuzz .= "<img src='".$this->plugin_url."images/social/soft_rect/googlebuzz.png' /></a></div>";

		/* Vkontakte */
		$vk_type .= "custom";
		$vk_text = '<img src="'.$this->plugin_url.'images/social/soft_rect/vkontakte.png" / title="Vkontakte">';
		$vkontakte .= "<div class='vk-myicon'>";

	} else if($customize_type=='soft_round') {

		/* Mail.ru */
		$mailru .= "<div class='mailru-myicon'>";
		$mailru .= "<a rel='nofollow' title='".__('Post to MyWorld', $this->plugin_domain)."' href=\"#mailru\" name=\"mailru\" onclick=\"new_window('http://connect.mail.ru/share?share_url=$url');\">";
		$mailru .= "<img src='".$this->plugin_url."images/social/soft_round/mailru.png' /></a></div>";

		/* Odnoklassniki */
                $odkl .= "<div class='odkl-myicon'>";
		$odkl .= "<a rel='nofollow' title='".__('Post to Odnoklassniki', $this->plugin_domain)."' href=\"#odnoklassniki\" name=\"odnoklassniki\" onclick=\"new_window('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=$url');\">";
		$odkl .= "<img src='".$this->plugin_url."images/social/soft_round/odnoklassniki.png' /></a></div>";

		/* Tweet */
		$twitter .= "<div class='twitter-myicon'>";
		$twitter .= "<a rel='nofollow' title='".__('Post to Twitter', $this->plugin_domain)."' href=\"#twitter\" name=\"twitter\" onclick=\"new_window('http://twitter.com/share?&text=$title%20-%20&url=$url$via_new');\">";
		$twitter .= "<img src='".$this->plugin_url."images/social/soft_round/twitter.png' /></a></div>";

		/* Facebook */
		$facebook .= "<div class='fb-myicon'>";
		$facebook .= "<a rel='nofollow' title='".__('Post to Facebook', $this->plugin_domain)."' href=\"#facebook\" name=\"facebook\" onclick=\"new_window('http://www.facebook.com/sharer.php?u=$url');\">";
		$facebook .= "<img src='".$this->plugin_url."images/social/soft_round/facebook.png' /></a></div>";

		$livejournal .= "<div class='live-journal'>";
		$livejournal .= "<a rel='nofollow' title='".__('Post to LiveJournal', $this->plugin_domain)."' href=\"http://www.livejournal.com/update.bml?event=".$url."&subject=".$title."\" target=\"_blank\" name =\"livejournal\"/>";
		$livejournal .= "<img src='".$this->plugin_url."images/social/soft_round/livejournal.png' /></a></div>";


		$googlebuzz .= "<div class='google-buzz'>";
		$googlebuzz .= "<a rel='nofollow' title='".__('Post to Google Buzz', $this->plugin_domain)."' href=\"http://www.google.com/buzz/post?message=".$title."&url=".$url."\">";
		$googlebuzz .= "<img src='".$this->plugin_url."images/social/soft_round/google-buzz.png' /></a></div>";

		/* Vkontakte */
		$vk_type .= "custom";
		$vk_text = '<img src="'.$this->plugin_url.'images/social/soft_round/vkontakte.png" / title="Vkontakte">';
		$vkontakte .= "<div class='vk-myicon'>";
	}

		$vkontakte .="<script type=\"text/javascript\">\r\n<!--\r\ndocument.write(VK.Share.button(\r\n{\r\n";
		$vkontakte .= "  url: '$url',\r\n";
		$vkontakte .= "  title: '$title',\r\n";
		$vkontakte .= "  description: '$descr'";
		$vkontakte .= $noparse == 'true' ? ",\r\n  noparse: $noparse \r\n}, \r\n{\r\n" : "  \r\n}, \r\n{\r\n";
		$vkontakte .= "  type: '$vk_type',\r\n";      
		$vkontakte .= "  text: '$vk_text'\r\n}));";
		$vkontakte .= "\r\n-->\r\n</script></div>\r\n";

	$array_buttons = array();
	$temp = array();

	$array_buttons = array($vkontakte, $mailru, $facebook, $odkl, $twitter, $livejournal, $googlebuzz);
        for($i=0;$i<count($array_buttons);$i++) {
	        $temp[get_option($this->social_name[$i])]=$array_buttons[$i];
		if($this->buttons_show[$i]<1) {
			unset($temp[get_option($this->social_name[$i])]);
		}
		array_values($temp);
	}


	ksort($temp);
	$button_code .= implode('', $temp);

?>