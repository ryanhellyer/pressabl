<?php
/**
 * @package WordPress
 * @subpackage Pressabl
 *
 * Pressabl
 */


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
		add_action( 'after_setup_theme', array( $this, 'post_thumbnails' ) );
		add_action( 'init', array( $this, 'fallback_css' ) );
		add_action( 'init', array( $this, 'settings_setup' ) );
		add_filter( 'gallery_style', array( $this, 'settings_remove_gallery_css' ) );
		add_filter( 'wp_title', array( $this, 'title' ), 1 );
		add_action( 'wp_print_scripts', array( $this, 'settings_scripts' ) );
		add_filter( 'wp_nav_menu', array( $this, 'menufilter' ) );
		add_filter( 'wp_page_menu', array( $this, 'menufilter' ) );
		add_action( 'widgets_init', array( $this, 'settings_widgets_init' ) );
		add_action( 'wp_head', array( $this, 'settings_head' ) );	
		add_filter( 'wppb_template_filter', array( $this, 'template_load' ) );
		add_action( 'wp_print_styles', array( $this, 'settings_css' ) );
		add_action( 'wp_print_styles', array( $this, 'deregister_css' ), 100 );
		add_action( 'wp_footer', array( $this, 'inline_page_stats' ) );
	}
	
	/**
	 * Remove inline styles printed when the gallery shortcode is used.
	 * Code borrowed from TwentyTen theme
	 *
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function settings_remove_gallery_css( $css ) {
		return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
	}

	/*
	 * Print the title tag based on what is being viewed.
	 * 
	 * @since 0.1
	 * @todo Remove need for output buffering (only used as stopgap to utilise original title code until new improved filter is ready)
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function title() {
		ob_start();
		// Single post
		if ( is_single() ) {
			single_post_title();
			echo ' | ';
			bloginfo( 'name' );
		}
		
		// Home page
		elseif ( is_home() ) {
			bloginfo( 'name' );
			echo ' | ';
			bloginfo( 'description' );
			if ( get_query_var( 'paged' ) )
				echo ' | Page ' . get_query_var( 'paged' );
		}
		
		// Static page
		elseif ( is_page() ) {
			single_post_title( '' );
			echo ' | ';
			bloginfo( 'name' );
		}
		
		// Search page
		elseif ( is_search() ) {
			bloginfo( 'name' );
			echo ' | Search results for ' . esc_html( $s ); 
			if ( get_query_var( 'paged' ) )
				echo ' | Page ' . get_query_var( 'paged' );
		}
		
		// 404 not found error
		elseif ( is_404() ) {
			bloginfo( 'name' );
			echo ' | Not Found';
		}
		
		// Anything else
		else {
			bloginfo( 'name' );
			wp_title( '|' );
			if ( get_query_var( 'paged' ) )
				echo ' | Page ' . get_query_var( 'paged' );
		}
		$title = ob_get_contents();
		ob_end_clean();
		return $title;
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
	 * Adds sf-menu to wp_nav_menu()
	 * Strips out wrapper tags so they can be added by hand via the templates
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function menufilter( $menu ) {
		
		// Adding class of .sf-menu
		$menu = preg_replace( '/<div class="menu"><ul>/', '', $menu, 1 ); // Remove opening DIV - wp_page_menu()
		$menu = preg_replace( '/<div class="menu-main-menu-container"><ul id="menu-main-menu" class="menu">/', '', $menu, 1 ); // Remove opening DIV - wp_nav_menu()
		$menu = preg_replace( '/" class="menu"><li/', '" class="pixopoint sf-menu"><li', $menu, 1 ); // Adding class of .sf-menu
		$menu = preg_replace( '/<\/ul><\/div>/', '', $menu, 1 ); // Remove closing DIV
		
		// Add has-children class
		$match = '#(<li id="[^"]+" class="[^"]+)("><a[^<]+</a>\s+<ul)#mis';
		$replace = '$1 has-children$2';
		$menu = preg_replace( $match, $replace, $menu );
		
		// Strip title attributes
		$menu = preg_replace( '/title=\"(.*?)\"/','',$menu );
		
		return $menu;
	}
	
	/**
	 * Register widgetized area and update sidebar with default widgets
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return void
	 */
	public function settings_widgets_init() {
	
		// Load widget settings
		$widgets = (array) get_wppb_option( 'widgets' );

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
		echo "\n<!-- Theme Generated via WP Paintbrush ... http://wppaintbrush.com/ -->\n\n";
	}
	
	/**
	 * Load the template
	 * Used when not utilizing the designer tool
	 * 
	 * @since 0.8
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function template_load( $wppb_template ) {
		return $wppb_template;
	}
	
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return void
	 */
	public function settings_setup() {

		// Setting the default content width
		if ( ! isset( $content_width ) )
			$content_width = 900;

		// Register navigation menus
		$menus = (array) get_wppb_option( 'menus' ); // Grab which menus to be loaded from DB
		foreach ( $menus as $key => $menu ) {
			register_nav_menu( 'menu' . $key, $menu['name_menu'] );
		}

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
	 * Load CSS
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return void
	 */
	public function settings_css() {
		
		// Bail out now if in admin panel or on login page
		if ( is_admin() OR strstr( $_SERVER['REQUEST_URI'], 'wp-login.php' ) )
			return;
		
		// Load CSS (uses PixoPoint templating framework function as addon plugins for the framework will allow for variations in how the CSS loaded, eg: inline CSS, static cached files etc.)
		$this->css( WPPB_SETTINGS );
	}
	
	/**
	 * Deregister the CSS file used by the exported themes
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return void
	 */
	public function deregister_css() {
		wp_deregister_style( 'css' );
	}
	
	/**
	 * Display inline page stats in footer
	 * Only bother if user is logged in
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function inline_page_stats() {
		echo "\n<!-- Number of queries = " . get_num_queries() . ". Time to execute = ";
		timer_stop( 1 );
		echo " -->\n";
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
		$wppb_template = get_wppb_option( $this->template_choice() ); // Load appropriate template
		$wppb_template = str_replace( '[get_header]', get_wppb_option( 'header' ), $wppb_template ); // Replacing header call with real code 
		$wppb_template = str_replace( '[get_footer]', get_wppb_option( 'footer' ), $wppb_template ); // Replacing footer call with real code
		$wppb_template = do_shortcode( $wppb_template ); // Creating content of shortcodes
		
		/*
		 * Boom!
		 * Template is spat out onto the page here :)
		 */
		echo $wppb_template;
		
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
		if ( is_front_page() ) {
			echo 'front page';
		}
		if ( is_page() ) {
			echo 'page';
		}
		if ( is_home() ) {
			echo 'home';
		}
		if ( is_front_page() && '' != get_wppb_option( 'front_page' ) )
			return 'front_page';
		elseif ( is_home() && '' != get_wppb_option( 'home' ) )
			return 'home';
		elseif ( is_page_template( 'page-template-1.php' ) )
			return 'page-template-1';
		elseif ( is_page_template( 'page-template-2.php' ) )
			return 'page-template-2';
		elseif ( is_page() && '' != get_wppb_option( 'page' ) )
			return 'page';
		elseif ( is_single() && '' != get_wppb_option( 'single' ) )
			return 'single';
		elseif ( is_archive() && '' != get_wppb_option( 'archive' ) )
			return 'archive';
		elseif ( is_404() )
			return 'page';
		else
			return 'index';
	}
	
	/**
	 * Load CSS from database if file doesn't exist
	 * This would only be used if the server didn't support writing to the uploads folder (to store the CSS file)
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function fallback_css() {
		
		if ( empty( $_GET[WPPB_SETTINGS] ) )
			return;
		
		$options = get_option( WPPB_SETTINGS ); // Get data
		header( 'Content-Type: text/css; charset=' . get_option( 'blog_charset' ) . ''); // Loading correct MIME type
		$css = $options['css'];
		
		echo $css; // Validate data and display CSS
		exit; // Kill execution now since no point in loading rest of WP
	}
	
	/**
	 * Declare CSS in HEAD
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return void
	 */
	public function css( $file_name ) {
		
		/* THIS SECTION HAS BEEN TEMPORARILY REMOVED - MINOR SECURITY ISSUES WERE PRESENT IN THIS IMPLEMENTATION - FUTURE ITERATIONS WILL USED A SLIGHTLY DIFFERENT APPROACH AND BE MORE PLUGGABLE
		// Check for static file first
		if ( file_exists( $uploads_folder['basedir'] . '/' . $file_name . '.css' ) ) {
			if ( !is_multisite() )
				wp_enqueue_style( $file_name, wppb_storage_folder() . '/' . $file_name . '.css', false, '', 'screen' ); // The main file which displays the users CSS - DIDN'T WORK WHEN PUSHED ONTO LIVE SERVER - SOMETHING TO DO WITH VERSIO NNUMBER MAKING CHROME NOT RECONISE IT AS A CSS FILE OR SOMETHING LIKE THAT 
			else
				echo "<link rel='stylesheet' id='" . $file_name . "'  href='" . wppb_storage_folder() . "/" . $file_name . ".css' type='text/css' media='screen' />"; // WP Multi-site is doing something weird with Mime types and hence causing issues so this is a dirty hack to get around this - may not be fullly working properly
		}
		else
		*/
		wp_enqueue_style( $file_name, home_url() . '/?' . $file_name . '=css', false, '', 'screen' ); // Fallback for when file doesn't exist
	}
	
	/**
	 * Registering post thumbnails
	 * @since 1.0
	 */
	public function post_thumbnails() {

		// Post thumbnails
		$thumbs = (array) get_wppb_option( 'thumbs' );

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
