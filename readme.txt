=== Simple Instagram Embed ===
Contributors: darkwhispering
Tags: social, plugin, instagram, embed, instagram embed, image, video
Requires at least: 3.0.0
Tested up to: 4.2.2
Stable tag: 1.3.0

Paste any link to a instagram picture or video in your post and the plugin replace your instagram link with the Instagram Embed directly in your posts just like wordpress replace your youtube links to youtube embeds.

== Description ==

Paste any link to a instagram picture or video in your post and the plugin replace your instagram link with the [Instagram Embed](http://blog.instagram.com/post/55095847329/introducing-instagram-web-embeds) directly in your posts just like wordpress replace your youtube links to youtube embeds.

Settings page avaliable to select between 3 different sizes to embed and if image/video caption should be included.

If you find any issues, please report them in the support section so they can be addressed. Thank you!

More info about the new Intagram Embed: http://blog.instagram.com/post/55095847329/introducing-instagram-web-embeds

Plugin also available on [Github](https://github.com/darkwhispering/Simple-Instagram-Embed)

== Installation ==

1. Upload the zipped file to yoursite/wp-content/plugins
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= I want the link in the embed to open in a new tab/window =
Yeah, so would I. Sadly, this is a behavior I can not control and it is up to Instagram to change this. Imo you should always open external links in new tabs, so I don't understand why Instagram have choosen not to with there embed.

== Screenshots ==

1. Embeded image in posts (large size)
2. Instagram url in pasted in editor
3. Plugin settings, select embed size

== Changelog ==

= 1.3.0 =
* Added settings option to include/exlude image/video caption in embed. Please be aware that long captions might push down below the hight of the embed iframe and by so activate scroll inside the iframe.
* Tested on Wordpress 4.2.2.
* Small update to the different size dimensions to allow for at least one row of caption.
* Updated code to better follow the Wordpress coding guidelines.

= 1.2.1 =
* Fixed issue with image urls containing a dash not beeing embeded properly
* Tested on WP 3.8.0

= 1.2.0 =
* Changed method to add the embed. Plugin now use wordpress wp_embed_register_handler insteada of a add_filter on the_content
* Fixed issue with embed breaking when content were added after the instagram link
* You can now have multiple embeds in the same post or page

= 1.0.2 =
* bug: Fixed issue with plugin breaking shortcodes or other plugins filtering *the_content*

= 1.0.1 =
* bug: http/https no longer displayed before the embed
* update: Tested on Wordpress 3.6

= 1.0.0 =
* Initial release
