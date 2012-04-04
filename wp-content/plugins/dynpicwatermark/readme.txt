=== DynPicWaterMark ===
Contributors: rlorenzoni
Donate link: 
Tags: watermark, dynamic, all images
Requires at least: 2.9.x
Tested up to: 2.9.2
Stable tag: 1.1

Adds dynamicaly a watermark to all images on posts.

== Description ==

DynPicWaterMark adds dynamicaly a watermark to your posted images on display time (no changes on original picture) . 
You can configure if it marks all your images or just the ones you set on post usage time. 
Watermark Position can be configured by post usage or a general default.
You can change the watermark whenever you want without having to process all images and upload.
It can be applied to all your current posts.

Watermarks size can be configured to be:

* a % of picture height or width;
* a fixed Height or width;
* the watermark original imge size.

== Installation ==

1. Download the plugin from [here](http://wordpress.org/extend/plugins/dynpicwatermark).
1. Extract all the files. 
1. Upload everything (keeping the directory structure) to the `/wp-content/plugins/` directory.
1. There should be a `/wp-content/plugins/dynpicwatermark` directory now with `dynpicwatermark.php` in it.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Visit the configuration tab to set default options and desired watermark (gif/png).

== Frequently Asked Questions ==

= Why My WaterMark is not trasnparent? =

Your watermark original file shout be a gif or png file with the desired transparency applied.

= How to set a image to NOT be marked? =

On the setting, be shure mark all images option is set to "NO".  And on post time select the file URL instead of the plugin link (altomatically replaced).

The FAQ is available at the [Plugin Homepage](http://wordpress.org/extend/plugins/dynpicwatermark)

== Screenshots ==

1. Plugin in use with lightbox on my website;
2. Plugin configuration.

== Changelog ==

= 1.1 =
* NEW option: creates a local Php.ini file for ajusting plugin Memory. This allows watermarking large images
* Improved: Better looking plugin interface at adding media to post screen

= 1.0.4 =
* Plugin name downcase on .php and png files tested and stable

= 1.0.3 =
* Plugin name downcase on .php and png files 

= 1.0.2 =
* Plugin name downcase on .png and png files

= 1.0 =
* Fist stable and tested version.

== Upgrade Notice ==

= 1.1 =
* NEW: Php plugin Memory configuration for large images
* imporved: Better looking plugin interface at adding media to post screen

= 1.0.4 =
* minor technical fix tested and stable

= 1.0.3 =
* minor technical fix

= 1.0.2 =
* minor technical fix

= 1.0 =
Fist stable and tested version.
