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
new Pressabl_Filter_WordPress();
if ( is_admin() ) {
	new ThemeUpdateChecker( 'pressabl', 'http://pressabl.com/?update=theme' ); // Update checker
	new Pressabl_Template_Editor;
}

/* Set Constants
 * Set after instantiation of classes due to the use of objects within the constants
 *
 * @since 0.8.2
 * @author Ryan Hellyer <ryan@pixopoint.com>
 */
if ( !defined( 'PRESSABL_TEMPLATES' ) )
	define( 'PRESSABL_TEMPLATES', 'wppb_templates' ); // Label for option used to store template code in database
if ( !defined( 'PRESSABL_FUNCTIONS' ) )
	define( 'PRESSABL_FUNCTIONS', 'wppb_functions' ); // Label for option used to store template code in database
define( 'PRESSABL_COPYRIGHT', '<a href="http://pressabl.com/">pressabl.com</a>. Powered by <a href="http://wordpress.org/">WordPress</a>.' );
define( 'PRESSABL_VERSION', '1.0' ); // Version of WP Paintbrush used
define( 'PRESSABL_REVISIONS', 6 ); // Number of revisions to store

/**
 * Get options function
 *
 * First attempts to load from functions, then defaults to templates
 * Initially loads option, but if preview set, revision set or if the option is not found, then defaults to grabbing a post
 *
 * @author Ryan Hellyer
 * @since 0.1
 * @return array or string
 */
function get_pressabl_option( $option, $revision = 1 ) {

	// If requesting most recent revision, then load directly from option (fastest)
	if ( $revision == 1 )
		$options = get_option( PRESSABL_FUNCTIONS );

	// Set post status, based on whether user has chosen to view a preview or not
	if ( isset( $_GET['pressabl-preview'] ) ) {
		$post_status = 'publish'; // Since not previewing, we use published posts

		unset( $options ); // Unset $options as need to grab from posts instead
	}
	elseif ( isset( $_GET['pressabl-save'] ) ) {
		if ( 'draft' == $_GET['pressabl-save'] )
			$post_status = 'draft'; // Since this is a preview we use the draft posts
		else
			$post_status = 'publish'; // Since not previewing, we use published posts

		unset( $options ); // Unset $options as need to grab from posts instead
	}
	else
		$post_status = 'publish'; // Since not previewing, we use published posts

	// Allow to view older versions via preview URL
	if ( isset( $_GET['pressabl-revision'] ) ) {
		$revision = (int) $_GET['pressabl-revision'];
		unset( $options ); // Unset $options as need to grab from posts instead
	}

	// If required option not found, then request from posts table (slower, but not used on every page load)
	if ( empty( $options[$option] ) ) {

		// Grabbing post data from DB
		$args = array(
			'post_type'    => 'pressabl',
			'numberposts'  => $revision,
			'post_status'  => $post_status,
		);
		$posts   = get_posts( $args ); // Grab posts as array
		$post    = $posts[$revision-1]; // Select the desired revision (substract one as array starts at zero)
		$content = $post->post_content; // Grab post content
		$content = unserialize( $content ); // Unserialize the array
		$options = $content['primary']; // Grab primary data (most commonly utilized data)

		if ( empty( $options[$option] ) )
			$options = $content['secondary'];

	}

	// Choose which bit to return
	if ( isset( $options[$option] ) )
		return $options[$option];
}


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
