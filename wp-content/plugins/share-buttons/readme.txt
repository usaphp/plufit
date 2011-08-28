=== Social Share Buttons for WordPress ===
Contributors: Loskutnikov Artem (artlosk)
Donate link:  http://sbuttons.ru/donate-en/
Tags: social, network, jquery, share buttons, social buttons, twitter, facebook, vkontakte, odnoklassniki, mail.ru, google, google-buzz, livejournal
Requires at least: 2.8
Tested up to: 3.0
Stable tag: 2.5

The Share buttons, it is plugin for social networks. The plugin supports 7 social networking.

== Description ==

The Share buttons, it is plugin for social networks. The plugin supports 7 social networking. 
There are Vkontakte, Odnoklassniki.ru, Mail.ru, LiveJournal russian social buttons and there are Facebook, Twitter, Google-Buzz english social buttons. 
Settings include show/hide buttons, sort buttons, position buttons and e.t.c.
This plugin is written using AJAX and Jquery. The plugin supports 2 languages: English and Russian

[FAQ]
-RUS (http://sbuttons.ru/tutorial-ru/installation-ru/)
-ENG (http://sbuttons.ru/tutorial-en/installation-en/) 

== Languages ==

* English - default
* Russina(ru_RU)

== Installation ==

1. Unzip the file
2. Upload it to wp-content/plugins
3. Activate it from the plugins section
4. Go to the FTP "wp-content/plugins/share_buttons/upload/ and change chmod folder "/UPLOADS/". Your logo will store in this folder.
NOTE:
or upload via FTP manually

== History URL ==

Third post about plugin ver 2.0   : http://artlosk.com/2010/12/social-share-buttons-ver-2-0/

Second post about plugin ver. 1.2 : http://artlosk.com/2010/11/social-share-buttons-ver-1-2/

First post about plugin ver. 1.0  : http://artlosk.com/2010/10/social-share-buttons/

== Changelog ==

[2.5]

Add Livejournal button
Add Google-Buzz button
Create Site for this plugin http://sbuttons.ru
Update russian language
Add text before social buttons
Change Sort
Fixed button Odnoklassniki
and e.t.c (few changes)

[2.2]

Fixed output "Like button for Vkontakte" when displayed in loop of posts. 
Now the button's container with a unique ID, for example &lt;div&gt; id='vk_like_$post->ID'>&lt;/div&gt;

[2.1]

Fixed URL for page

[2.0]

- Fixed upload file "logo.png"
- Fixed output description and title
- Fixed Facebook button with count
- Optimized plugin
- Change interface
- Change structure folder, files and php code
- Add fieldset "Sorting buttons"
- Add 6 pack icons
- Add Mail.ru button "Like"
- Add Share Buttons for Frontend(Home page)

[1.2.2]

Fixed get url for twitter, mailru buttons.
"$url = get_permalink($post->ID);"

[1.2.1]
Fixed output <meta>. Output without html.

if upload logo is failed, please, change chmod folder "uploads" and chmod file "logo.png" to upload logo for stie
or upload via FTP manually (this script while in the process)

[1.2]
 - Previously, the plugin inscribe title and description, which was introduced Platinum SEO Pack plugin and like it. Now the plugin takes from post and cuts 300 characters to description. <meta name="description" content="$description" />
 - Optimized scripts social networking.

[1.1]
Fixed upload logo

[1.0]
Plugin release.

== Feature ==
- Add many share buttons
- Create special site for this plugin