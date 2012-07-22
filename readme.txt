=== Pressabl ===
Contributors: Ryan Hellyer
Donate link: http://pressabl.com/
Tags: dark, light, white, black, gray, red, orange, yellow, green, blue, purple, one-column, two-columns, three-columns, left-sidebar, right-sidebar, fixed-width, flexible-width, custom-background, custom-colors, custom-header, custom-menu, featured-image-header, featured-images, full-width-template, theme-options, translation-ready
Requires at least: 3.4
Stable tag: 1.0

STUFF TO DO:
1. Static file storage of CSS and templates
2. Clean up syntax around line 720 of class-pixopoint-template-editor.php
3. Add child theme system - including setting up default json encoded files ... register_theme()
4. Clean up CSS parsing code
5. process_thumbnails() should not parsed stuff into different format ... need different method for that since also need to use sanitization function for stuff coming from data.tpl file ... ie: data.tpl isn't in same format as stuff direct from <form>. Probably have same problem on wdigets and menus too. Might pay to standardise parsing code across widgets, menus and thumbnails if possible too.
6. Perhaps replace options with transients and ditch standard wp-cache calls - can then eliminate PRESSABL_TEMPLATE_CACHE_TIME since they'd be ditched at appropriate time anyway
7. Use transient caching on widget sections - make sure it invalidates when widgets edited
8. Allow for other page templates ... http://www.wptavern.com/forum/themes-templates/1926-creating-page-templates-via-plugin.html
9. Allow for automatically added custom post-type templates
10. Don't use PHP generated CSS file, use inline styling instead
11. Use WP HTTP API for CSS file
12. Make sure CSS file uses different version on each edit of it

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
