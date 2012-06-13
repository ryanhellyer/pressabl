<?php

/**
 * Addition of CSS functionality
 * 
 * @copyright Copyright (c), PixoPoint
 * @license http://www.gnu.org/licenses/gpl.html GPL
 * @author Ryan Hellyer <ryan@pixopoint.com>
 * @since 1.0
 */
class Pressabl_CSS extends Pressabl {

	/**
	 * Constructor
	 * Add methods to appropriate hooks and filters
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * 
	 * @since 1.0
	 */
	public function __construct() {
		// Bail out now if in admin panel or on login page
		if ( is_admin() OR strstr( $_SERVER['REQUEST_URI'], 'wp-login.php' ) )
			return;

		// Load stylesheet
		// ******** If using static files, then should have check for file_exists here *********
		add_action( 'init', array( $this, 'fallback_css' ) );
		if ( isset( $_GET['pressabl-revision'] ) )
			add_action( 'wp_print_styles', array( $this, 'inline_css' ) );
		else
			add_action( 'init', array( $this, 'external_css' ) );
	}

	/**
	 * Load CSS from database if file doesn't exist
	 * This would only be used if the server didn't support writing to the uploads folder (to store the CSS file)
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function fallback_css() {

		if ( empty( $_GET[PRESSABL_FUNCTIONS] ) )
			return;

		header( 'Content-Type: text/css; charset=' . get_option( 'blog_charset' ) . ''); // Loading correct MIME type
		echo $this->get_option( 'css' );

		exit; // Kill execution now since no point in loading rest of WP
	}

	/**
	 * Enqueue CSS file
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function external_css() {
		wp_enqueue_style( PRESSABL_FUNCTIONS, home_url() . '/?' . PRESSABL_FUNCTIONS . '=css', false, '', 'screen' ); // Fallback for when file doesn't exist
	}
	
	/**
	 * Dump CSS out inline
	 * Used for when testing, or if no ability to write files
	 * 
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function inline_css() {
		echo '<style>' . $this->get_option( 'css' ) . '</style>';
	}

}
