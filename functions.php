<?php
/**
 * @package WordPress
 * @subpackage Pressabl theme
 * @since Pressabl 0.1
 *
 * Functions
 */

/**
 * Do not continue processing since file was called directly
 * @since 0.1
 */
if ( !defined( 'ABSPATH' ) )
	die( 'Eh! What you doin in here?' );

/**
 * Load required files
 * Some files not loaded unless in admin panel
 * @since 0.1
 */
require( get_template_directory() . '/inc/class-pressabl.php' ); // Loading primary Pressabl class
require( get_template_directory() . '/inc/class-pressabl-css.php' ); // Loading primary Pressabl class
require( get_template_directory() . '/inc/class-pressabl-filter-wordpress.php' ); // Loading primary Pressabl class
require( get_template_directory() . '/inc/class-pressabl-templating-framework.php' ); // Loading PixoPoint templating framework
require( get_template_directory() . '/inc/class-breadcrumb-navigation-xt.php' ); // Load the breadcrumb class
if ( is_admin() ) {
	require( get_template_directory() . '/inc/class-pressabl-template-editor.php' ); // Admin specific functions
	require( get_template_directory() . '/inc/theme-update-checker.php' ); // Load theme update checker - needs loaded only once due to being used in child themes
	require( get_template_directory() . '/inc/csstidy/class.csstidy.php' ); // Loading CSS Tidy
	require( get_template_directory() . '/inc/csstidy/index.php' ); // Loading CSS Tidy extension
}

/**
 * Instantiate classes
 * @since 1.0
 */
$pressabl = new Pressabl(); // Pressabl theme
new Pressabl_Templating_Framework(); // Templating framework
new Pressabl_CSS();
if ( is_admin() ) {
	new ThemeUpdateChecker( 'pressabl', 'http://pressabl.com/?update=theme' ); // Update checker
	new Pressabl_Template_Editor;
} else {
	new Pressabl_Filter_WordPress();
}

/* Set Constants
 * Set after instantiation of classes due to the use of objects within the constants
 *
 * @since 0.8.2
 * @author Ryan Hellyer <ryan@pixopoint.com>
 */
define( 'PRESSABL_TEMPLATES', 'wppb_templates' ); // Label for option used to store template code in database
define( 'PRESSABL_FUNCTIONS', 'wppb_functions' ); // Label for option used to store template code in database
define( 'PRESSABL_COPYRIGHT', '<a href="http://pressabl.com/">pressabl.com</a>. Powered by <a href="http://wordpress.org/">WordPress</a>.' );
define( 'PRESSABL_VERSION', '1.0' ); // Version of WP Paintbrush used
define( 'PRESSABL_REVISIONS', 100 ); // Number of revisions to store
define( 'PRESSABL_CACHE_TIME', 30 ); // Number of seconds to cache templates for



/*
The following is just junk that is required to pass the official WordPress theme check
This code is totally pointless and serves no purpose in this theme, but has been
placed it in here just to make it pass the automated tests. WP Paintbrush adds these
functions dynamically, so are not required within the raw template files themselves.

comments_template();
add_custom_image_header();
add_custom_background();
add_editor_style();
*/
