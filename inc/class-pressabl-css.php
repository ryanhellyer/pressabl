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
		if ( isset( $_GET['pressabl-revision'] ) )
			add_action( 'wp_print_styles', array( $this, 'inline_css' ) );
		else
			add_action( 'init', array( $this, 'external_css' ) );
	}

	/**
	 * Enqueue CSS file
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function external_css() {
		$uploads_dir = $this->get_uploads_dir();
		$css_file_location = $uploads_dir . '/style-' . $this->get_option( 'id' ) . '.css'; // File location

		// Only load if file exists
		if ( file_exists( $css_file_location ) ) {
			$uploads_url = $this->get_uploads_dir( 'url' );
			$css_file_url = $uploads_url . '/style-' . $this->get_option( 'id' ) . '.css'; // File location
			wp_enqueue_style(
				PRESSABL_FUNCTIONS,
				$css_file_url,
				false,
				'',
				'all'
			);
		}
		else {
			add_action( 'wp_print_styles', array( $this, 'inline_css' ) );
		}
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
