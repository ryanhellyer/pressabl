<?php

/**
 * Primary class used to load the theme
 * 
 * @copyright Copyright (c), PixoPoint
 * @license http://www.gnu.org/licenses/gpl.html GPL
 * @author Ryan Hellyer <ryan@pixopoint.com>
 * @since 1.0
 */
class Pressabl {

	/**
	 * Constructor
	 * Add methods to appropriate hooks and filters
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'init',                 array( $this, 'settings_setup' ) );
		add_action( 'init',                 array( $this, 'register_post_type' ) );
		add_action( 'wp_print_scripts',     array( $this, 'settings_scripts' ) );
		add_action( 'wp_head',              array( $this, 'settings_head' ) );	
		add_action( 'wp_footer',            array( $this, 'inline_page_stats' ) );

		add_action( 'widgets_init',         array( $this, 'register_widgets' ) );
		add_action( 'after_setup_theme',    array( $this, 'post_thumbnails' ) );
		add_action( 'after_setup_theme',    array( $this, 'register_menus' ) );
	}

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
	function get_option( $option, $revision = 1 ) {
	
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

	/**
	 * Create custom post type for storing templates
	 *
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return void
	 */
	public function register_post_type() {

		// Set arguments for custom post-type
		$args = array(
			'labels'              => array(
				'name'                 => 'Pressabl templates', // Name
				'singular_name'        => 'pressabl', // Singular Name
			),
			'public'              => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type' 	  => 'post',
		);

		// Register custom post-type
		register_post_type( 'pressabl', $args );
	}

	/**
	 * Loading scripts
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function settings_scripts() {

		// Bail out now if in admin panel or on login page
		if ( is_admin() OR strstr( $_SERVER['REQUEST_URI'], 'wp-login.php' ) )
			return;

		echo '<!--[if lt IE 9]><script src="' . get_template_directory_uri() . '/scripts/html5.js" type="text/javascript"></script><![endif]-->';

		// Comments
		if ( is_singular() )
			wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Register navigation menus
	 * 
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function register_menus() {
		$menus = (array) $this->get_option( 'menus' ); // Grab which menus to be loaded from DB
		foreach ( $menus as $key => $menu ) {
			register_nav_menu( 'menu' . $key, $menu['name_menu'] );
		}
	}

	/**
	 * Register widgetized area and update sidebar with default widgets
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function register_widgets() {

		// Load widget settings
		$widgets = (array) $this->get_option( 'widgets' );

		foreach ( $widgets as $key => $widget ) {

			register_sidebar(
				array (
					'name'           => $widget['name_widget'],
					'id'             => 'widgetarea' . $key,
					'description'    => $widget['description_widget'],
					'before_widget'  => $widget['before_widget'],
					'after_widget'   => $widget['after_widget'],
					'before_title'   => $widget['before_title'],
					'after_title'    => $widget['after_title'],
				)
			);

		}
	}
	
	/**
	 * Add stuff to wp_head()
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function settings_head() {
		echo "<link rel='pingback' href='" . get_bloginfo( 'pingback_url' ) . "' />\n";
		echo "<link rel='author' href='" . get_template_directory_uri() . "/humans.txt' />\n";
		echo "\n<!-- Theme Generated via Pressabl ... http://pressabl.com/ -->\n\n";
	}

	/**
	 * Sets up theme defaults and settings
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function settings_setup() {

		// Register support for automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'wppb_settings', get_template_directory() . '/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . '/languages/$locale.php';
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

	}

	/**
	 * Display inline page stats in footer
	 * Only bother if user is logged in
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function inline_page_stats() {
		echo "\n<!-- This Pressabl (http://pressabl.com/) powered site used " . get_num_queries() . " queries and took ";
		timer_stop( 1 );
		echo " seconds to execute -->\n";
	}

	/**
	 * Main function used for launching the theme
	 * Used in primary template files (index.php, page.php etc)
	 *
	 * @since 1.0.6
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function launch_theme() {

		/*
		 * Load the header here
		 * 
		 * The actual header.php is not parsed through the templating system.
		 * The header added in the templating system is parsed into regular code and dumped out above >
		 */
		get_header();

		/*
		 * This is where all the magic happens inside the theme.
		 * 
		 * Templates are grabbing from database
		 * The header and footer calls are replaced with their corresponding code
		 * Shortcodes are parsed to automagically turn the templates into usable code
		 */
		$template = $this->get_option( $this->template_choice() ); // Load appropriate template
		$template = str_replace( '[get_header]', $this->get_option( 'header' ), $template ); // Replacing header call with real code 
		$template = str_replace( '[get_footer]', $this->get_option( 'footer' ), $template ); // Replacing footer call with real code
		$template = do_shortcode( $template ); // Creating content of shortcodes

		/*
		 * Boom!
		 * Template is spat out onto the page here :)
		 */
		echo $template;

		/*
		 * Load the footer here
		 * 
		 * The actual footer.php is not parsed through the templating system.
		 * The footer added in the templating system is parsed into regular code and dumped out above^
		 */
		get_footer();

	}

	/**
	 * Grab storage folder
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function storage_folder() {
		$uploads_folder = wp_upload_dir(); // grab uploads folder
		$folder = $uploads_folder['basedir'];  // grab the WP Paintbrush folder
		$folder = $uploads_folder['baseurl'];  // grab the WP Paintbrush folder
		$folder = $folder . '/' . WPPB_STORAGE_FOLDER;  // Add the WP Paintbrush folder to the string
		
		return $folder;
	}
	
	/**
	 * Load appropriate template
	 * 
	 * @since 0.8
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	private function template_choice() {
		if ( is_front_page() && '' != $this->get_option( 'front_page' ) )
			return 'front_page';
		elseif ( is_home() && '' != $this->get_option( 'home' ) )
			return 'home';
		elseif ( is_page_template( 'page-template-1.php' ) )
			return 'page-template-1';
		elseif ( is_page_template( 'page-template-2.php' ) )
			return 'page-template-2';
		elseif ( is_page() && '' != $this->get_option( 'page' ) )
			return 'page';
		elseif ( is_single() && '' != $this->get_option( 'single' ) )
			return 'single';
		elseif ( is_archive() && '' != $this->get_option( 'archive' ) )
			return 'archive';
		elseif ( is_404() )
			return 'page';
		else
			return 'index';
	}
	
	/**
	 * Registering post thumbnails
	 * @since 1.0
	 */
	public function post_thumbnails() {

		// Post thumbnails
		$thumbs = (array) $this->get_option( 'thumbs' );

		// Add theme support for post thumbnails (only if a thumbnail is specified)
		if ( isset( $thumbs['name'] ) )
			add_theme_support( 'post-thumbnails' );

		// Loop through all the thumbnails and add their corresponding image sizes
		foreach ( $thumbs as $key => $thumb ) {

			add_image_size(
				(string) $thumb['name'], // name
				(int) $thumb['width'], // width
				(int) $thumb['height'], // height
				(boolean) $thumb['hardcrop'] // hard crop?
			);

		}
	}
}
