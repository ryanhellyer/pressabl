=== Pressabl ===
Contributors: Ryan Hellyer
Donate link: http://pressabl.com/
Tags: dark, light, white, black, gray, red, orange, yellow, green, blue, purple, one-column, two-columns, three-columns, left-sidebar, right-sidebar, fixed-width, flexible-width, custom-background, custom-colors, custom-header, custom-menu, featured-image-header, featured-images, full-width-template, theme-options, translation-ready
Requires at least: 3.3
Stable tag: 1.0

STUFF TO DO:
1. CHANGE THUMBNAILS TO USE SERIALISED ARRAY - ALLOWS FOR AS MANY THUMBNAILS AS YOU LIKE
2. DO SERISALISATION SHIT FOR MENUS and WIDGETS AS WELL AS THUMBNAILS
3. Static file storage of CSS and templates
4. @params for PhpDocs
5. @access for private stuff
6. Clean up syntax around line 720 of class-pixopoint-template-editor.php
7. Add child theme system - including setting up default json encoded files ... register_theme()
8. Clean up CSS parsing code
9. PixoPoint_Template_Editor class should maybe be relabelled as something to do with Pressabl instead of PixoPoint?
10. process_thumbnails() should not parsed stuff into different format ... need different method for that since also need to use sanitization function for stuff coming from data.tpl file ... ie: data.tpl isn't in same format as stuff direct from <form>. Probably have same problem on wdigets and menus too. Might pay to standardise parsing code across widgets, menus and thumbnails if possible too.

The file is a work in progress ... 

== Description ==

Pressabl ... 

== Installation ==

1. Upload the `pressabl` folder to the `/wp-content/themes/` directory
2. Activate the Theme through the 'Themes' menu in WordPress

== Theme Notes ==

== Frequently Asked Questions ==

= Can I extend Pressabl? =

Yes

== Screenshots ==

1. Template editor

== Changelog ==

= 1.0 [29/2/2012] =
* Initial fork from WP Paintbrush

== Upgrade Notice ==

= 1.0 =
Fork from WP Paintbrush - no upgrade just yet
