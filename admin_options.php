<?php
/**
 * @package WordPress
 * @subpackage WP Paintbrush
 * @since WP Paintbrush 1.0
 */


/**
 * Grabs a design
 * Used when importing templates
 * @since 0.1
 */
function wppb_grab_design( $design ) {

	// Starting importation process
	$file = get_theme_root() . '/' . $design . '/data.tpl';
	if ( !file_exists( $file ) )
		return get_option( WPPB_SETTINGS ); // If file doesn't exist, just load existing template

	// Shoving file contents into string
	$data = file_get_contents( $file );

	// Processing data ready for database
	$data = explode( WPPB_BLOCK_SPLITTER, $data ); // Splitting data
	$counter = 0;
	$wppb_options = array();
	while ( $counter <= 100 ) {
		if ( !isset( $data[$counter+1] ) )
			$data[$counter+1] = '';
		$split = explode( WPPB_NAME_SPLIT_START, $data[$counter+1] ); // Splitting data
		if ( !isset( $split[1] ) )
			$split[1] = '';
		$split = explode( WPPB_NAME_SPLIT_END, $split[1] ); // Splitting data
		$name = $split[0];

		if ( !isset( $split[1] ) )
			$split[1] = '';
		$wppb_options[$name] = $split[1];
		$counter++;
	}

	// Return array
	return $wppb_options;
}

/**
 * Init options to white list our options
 * Store initial settings in DB
 * 
 * @since 0.1
 */
function wppb_options_init() {

	// Register settings
	register_setting( 'wppb_settings_import', 'wppb_settings_theme_import', 'wppb_settings_import_validate' );

	$wppb_design = wppb_grab_design( 'wppaintbrush' ); // Grab default design

	// Adding initial settings
	add_option( WPPB_SETTINGS, $wppb_design );
}
add_action( 'admin_init', 'wppb_options_init' );

/* Change uploads folder
 * Only changes it if a specific form field was present - which is dynamically added via WP Paintbrush when using the media uploader on the front-end
 * @since 1.0
 */
function wppb_change_uploads_folder() {
	if ( isset( $_POST['wppb'] ) ) {
		if ( 'wppb' == $_POST['wppb'] )
			add_filter( 'upload_dir', 'wppb_image_uploads_folder' );
	}
}
add_action( 'admin_init', 'wppb_change_uploads_folder', 9 );

/**
 * Setting the folder for storing images
 * Used for filtering in wppb_image_upload_form_check() 
 * @since 0.9
 */
function wppb_image_uploads_folder( $upload ) {
	$upload['path'] = $upload['basedir'] . '/' . WPPB_STORAGE_FOLDER . '/images';
	$upload['url'] = $upload['baseurl'] . '/' . WPPB_STORAGE_FOLDER . '/images';
	return $upload;
}

/**
 * Adding paramater to plup uploader
 * Required for submitting extra field to indicate when using alternate storage folder
 * @since 1.0
 */
function wppb_plup_post_parameters( $post_params ) {
	$post_params['wppb'] = 'wppb';
	return $post_params;
}
if ( isset( $_GET['wppb_frontenduploader'] ) ) {
	if ( 'css' == $_GET['wppb_frontenduploader'] )
		add_filter( 'upload_post_params', 'wppb_plup_post_parameters' );
}

/**
 * Add extra input field to pluploader
 * @since 1.0
 */
function wppb_plup_add_input() {
	echo "\n	<input id='wppb' type='hidden' value='wppb' name='wppb' />\n";
}
add_action( 'pre-upload-ui', 'wppb_plup_add_input' );

/**
 * Display list of uploaded images
 * @since 0.1
 */
function wppb_display_images() {
	$file_list = wppb_list_files( wppb_storage_folder( 'images' ) );
	if ( is_array( $file_list ) ) {
		foreach ( $file_list as $file ) {
			echo '<li>
				<a href="' . wppb_storage_folder( 'images', 'url' ) . '/' . $file . '">' . $file . '</a>
				<input class="delete_file" type="submit" name="delete_file" value="' . $file . '" />
				<br />
				<a href="' . wppb_storage_folder( 'images', 'url' ) . '/' . $file . '">
					<img src="' . wppb_storage_folder( 'images', 'url' ) . '/' . $file . '" class="uploaded-image" alt="" />
				</a>
			</li>';
		}
	}
}

/**
 * Create the options page
 * @since 0.1
 */
function upload_images_do_page() {

	// Security checks
	wppb_image_upload_form_check();

?>
<div class="wrap">
	<?php
		// Create screen icon by heading
		screen_icon( 'wppb-icon' ); echo '<h2>' . __( 'Upload images' ) . '</h2>';

		// "Options Saved" message as displayed at top of page on clicking "Save"
		if ( isset( $_REQUEST['updated'] ) )
			echo '<div class="updated fade"><p><strong>' . __( 'Options saved' ) . '</strong></p></div>';
	?>
	<h3><?php _e( 'Upload images here', 'wppb_lang' ); ?></h3>

	<form method="post" action="" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
		<?php wp_nonce_field( 'wppb_upload_image','image'); ?>
		<p>
			<?php _e( 'Note: This section is for adding and deleting images used in your theme only. For image uploads in your posts/pages please visit the ', 'wppb_lang' ); ?>
			<a href="<?php echo admin_url(); ?>upload.php"><?php _e( 'Media uploader', 'wppb_lang' ); ?></a>
		</p>
		<?php wppb_image_upload_form_fields(); ?>
		<ol>
			<?php wppb_display_images(); ?>
		</ol>
	</form>
</div>

<?php
}

/**
 * Load up the menu pages
 * @since 0.1
 */
function wppb_settings_options_add_page() {

	// Upload images admin page
	$page = add_theme_page(
		__( 'Images', 'wppb_lang' ),
		__( 'Images', 'wppb_lang' ),
		'edit_theme_options',
		'upload_images',
		'upload_images_do_page'
	);
	add_action( 'admin_print_styles-' . $page, 'wppb_settings_admin_styles' ); // Add styles (only for this admin page)

	// Add reset theme admin page
	$page = add_theme_page(
		__( 'Reset', 'wppb_lang' ),
		__( 'Reset', 'wppb_lang' ),
		'administrator',
		'wppb_reset_page',
		'wppb_reset_pagecontent'
	);
	add_action( 'admin_print_styles-' . $page, 'wppb_settings_admin_styles' ); // Add styles (only for this admin page)
}
add_action( 'admin_menu', 'wppb_settings_options_add_page' ); // Creat admin page


/**
 * Add more information link to theme page
 * @since 1.0.6
 */
function wppb_theme_demo_link( $actions, $theme ) {
	if ( 'wppaintbrush' == $theme['Stylesheet'] )
		$actions[] = '<a href="http://wppaintbrush.com/">More information</a>';
	return $actions;
}
add_filter( 'theme_action_links', 'wppb_theme_demo_link', 10, 2 );

/**
 * Redirects after resetting theme
 * @since 1.0.6
 */
function wppb_reset_pagecontent() {
?>
<div class="wrap">
	<?php
	// Reset theme
	if ( isset( $_GET['wppb_reset_theme'] ) ) {
		echo '<div class="updated fade"><p><strong>';
		// Security check
		if ( !wp_verify_nonce( $_REQUEST['_wpnonce'], 'wppb_reset_theme') )
			 _e( 'Error: Incorrect nonce value. Theme was not reset!', 'wppb_lang' );
		else {
			delete_option( WPPB_SETTINGS );
			delete_option( WPPB_DESIGNER_SETTINGS );
			wppb_theme_setup( 'autoload' );

			_e( 'Your theme has been reset', 'wppb_lang' );
		}
		echo '</strong></p></div>';
	}

	// Create screen icon by heading
	screen_icon( 'wppb-icon' ); echo '<h2>' . __( 'Reset your theme', 'wppb_lang' ) . '</h2>';
	?>
	<p><strong><?php _e( 'Warning', 'wppb_lang' ); ?>:</strong> <?php _e( 'Only use this option if you want to wipe your changes to your theme and start over from scratch!', 'wppb_lang' ); ?></p>
	<p class="submit"><a id="submit" class="button-primary" href="<?php
		echo wp_nonce_url(
			admin_url() . 'themes.php?page=wppb_reset_page&wppb_reset_theme=yes',
			'wppb_reset_theme'
		);
	?>">Reset theme</a></p>
</div>

<?php
}


/**
 * Confirm checkboxes are set correctly
 * @since 0.1
 */
function wppb_validate_checkboxes( $input ) {
	if ( 'on' == $input OR '' == $input )
		return $input;
	else
		return;
}

/**
 * Check for string inside string
 * @since 0.7
 */
function wppb_string_in_templates( $needle ) {
	
	// Compile array together - check if is an array beforehand so doesn't spit PHP error out when new site is created (and option is empty - hence not an array)
	if ( is_array( get_wppb_option() ) )
		$templates_combined = array_reduce ( get_wppb_option(), 'wppb_callback_string_in_templates' );
	elseif ( !isset( $templates_combined ) )
		$templates_combined = '';

	$pos = strpos( 
		$templates_combined,
		$needle
	);
	if ( $pos === false ) {
	}
	else
		return true; // string needle found in haystack
}

/**
 * Callback for wppb_string_in_templates()
 * @since 0.7
 */
function wppb_callback_string_in_templates( $v1, $v2 ) {
	return $v1 . "\n\n\n\n\n" . $v2;
}

/**
 * Utilized within child themes for changing to a new design
 * @since 1.0.6
 */
function wppb_childtheme_version_error() {
	$wppb_childtheme_data = get_theme_data( get_stylesheet_directory_uri() . '/style.css' );
	echo '<div class="updated fade"><p>' . __( 'Sorry, but the', 'wppb_lang' ) . $wppb_childtheme_data['Name'] . __( ' child theme requires a newer version of <a href="http://wppaintbrush.com/">WP Paintbrush</a>. Please <a href="http://wppaintbrush.com/">upgrade WP Paintbrush</a>.', 'wppb_lang' ) . '</p></div>';
}

/**
 * Utilized within child themes for changing to a new design
 * @since 1.0.6
 */
function wppb_theme_setup( $autoload='' ) {
	global $pagenow;

	// Spit error out if child theme requires newer version of WP Paintbrush (and on themes page)
	if ( '' != WPPB_CHILD_VERSION && 'themes.php' == $pagenow ) {
		$wppb_theme_data = get_theme_data( get_template_directory_uri() . '/style.css' );
		echo WPPB_CHILD_VERSION . $wppb_theme_data['Version'];
		if ( $wppb_theme_data['Version'] < WPPB_CHILD_VERSION )
			add_action( 'admin_notices', 'wppb_childtheme_version_error' );
	}

	$css = get_wppb_option( 'css' ); // Used for checking if data stored
	if ( ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' && !isset( $css ) ) || 'autoload' == $autoload ) { 

		// Grab design
		if ( defined( 'WPPB_CHILD_THEME' ) )
			$wppb_design = wppb_grab_design( WPPB_CHILD_THEME ); // Grab child theme design
		else
			$wppb_design = wppb_grab_design( 'wppaintbrush' ); // Grab default design

		// Change the design to the one specified (alters front-end editor settings)
		wppb_change_design( $wppb_design );

		// Publish theme
		wppb_publish_options( $wppb_design, $wppb_design['css'] );

	} 
}


/**
 * Create checkboxes
 * @since 0.1
 */
if ( !function_exists( 'pixopoint_checkboxes' ) ) :
function pixopoint_checkboxes( $opt, $options, $name ) {

	// Setting checked value
	if ( 'on' == $options[$opt] )
		$checked = 'checked="yes" ';
	else
		$checked = '';
	echo '<input type="checkbox" name="' . $name . '[' . $opt . ']" ' . $checked . '/>';
}
endif;
