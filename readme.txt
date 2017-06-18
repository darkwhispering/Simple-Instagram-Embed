=== Simple Instagram Embed ===
Contributors: darkwhispering
Donate link: http://darkwhispering.com/buy-me-a-beer
Tags: social, plugin, instagram, embed, instagram embed, image, video, oembed
Requires at least: 3.0.0
Tested up to: 4.6.0
Stable tag: 2.1.1

Paste any link to a Instagram picture or video in your post and the plugin replace your Instagram link with the Instagram Embed directly in your posts just like Wordpress replace your Youtube links to Youtube embeds.

== Description ==

Paste any link to a Instagram picture or video in your post and the plugin replace your Instagram link with the [Instagram Embed](http://blog.instagram.com/post/55095847329/introducing-instagram-web-embeds) directly in your posts just like Wordpress replace your Youtube links to Youtube embeds.

Settings page available where you can specify the maximum width the embed is allowed to be, and hide the caption if you would like that.
If you site is responsive, the embed will resize down nicely on tablet and mobile devices.

If you find any issues, please report them in the support section so they can be addressed. Thank you!

Plugin also available on [Github](https://github.com/darkwhispering/Simple-Instagram-Embed)

== Installation ==

1. Upload the zipped file to yoursite/wp-content/plugins
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Why use this plugin when Wordpress now have built in support for Instagram embed =
It is correct that Wordpress now have built in support for the Instagram embed. What you don't have is control over the site of the embed and if the image/video caption should be included or not. You can control both of these aspects with this plugin in the settings page.

= Image/video is not showing =
You can only embed images/videos from public profiles. Images from private profiles will not display. So make sure the image you are trying to embed belongs to a user with a public profile.

= I don't want likes and/or comments to be displayed =
Unfortunately Instagram does not provide any option to hide likes and comments from the embed.

= I want the link in the embed to open in a new tab/window =
Yeah, so would I. Sadly, this is a behavior I can not control and it is up to Instagram to change this. Imo you should always open external links in new tabs, so I don't understand why Instagram have choose not to with there embed.

== Screenshots ==

1. Plugin settings

== Changelog ==

= 2.1.1 =
* Minor code formatting fixes
* Minor changes to readme
* Tested on Wordpress 4.5.2

= 2.1.0 =
* Fixed broken Instagram api URL used in cURL to load embed iframe.

= 2.0.0 =
* Now using the [Instagram oembed API](https://www.instagram.com/developer/embedding/#oembed) endpoint instead of old fashioned iframe embed.
* Embeds are now fully responsive and scales nicely for mobile devices.
* Completely recoded the settings page to leverage the Wordpress Settings API. Better late then never...
* Any max width size can now be set in the settings page. No predefined sizes anymore.
* Caption option on settings page has been change from *display* to *hide* caption if checked.
* Fixed issue where embed broke if *www.* was included in the instagram URL.
* Tested on Wordpress 4.4

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
