<?php
/**
 * @package WordPress
 * @subpackage Pressabl theme
 * @since Pressabl 0.1
 *
 * Admin pages
 */


/**
 * Pressabl admin pages
 * 
 * @copyright Copyright (c), PixoPoint
 * @license http://www.gnu.org/licenses/gpl.html GPL
 * @author Ryan Hellyer <ryan@pixopoint.com>
 * @since 1.0
 */
class Pressabl_Template_Editor {

	/**
	 * Constructor
	 * Add methods to appropriate hooks and filters
	 * 
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function __construct() {
		add_action( 'init',               array( $this, 'register_theme' ) );
		add_action( 'admin_menu',         array( $this, 'add_admin_page' ) );
		add_action( 'wp_dashboard_setup', array( $this, 'admin_add_dashboard_widgets' ) );
		add_action( 'admin_notices',      array( $this, 'php5_2_error_message' ) );
	}

	/**
	 * Allowed HTML
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @access private
	 */
	private $allowed_html = array(
		'a'       => array(
			'href'       => array(),
			'title'      => array(),
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'div'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'form'     => array(
			'role'       => array(),
			'method'     => array(),
			'action'     => array(),
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'input'     => array(
			'placeholder'=> array(),
			'type'       => array(),
			'value'      => array(),
			'name'       => array(),
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'span'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'p'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'h1'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'h2'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'h3'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'h4'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'h5'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'h6'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'table'      => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'blockquote'      => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'small'      => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'code'      => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'pre'       => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'tr'        => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
			'td'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'th'        => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'thead'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'tfoot'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'style'     => array(
			'type'       => array(),
			'id'         => array(),
			'rel'        => array(),
			'media'      => array(),
			'href'       => array()
		),
		'ul'        => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'li'        => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'ol'         => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'img'         => array(
			'src'        => array(),
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'article'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'aside'       => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'header'      => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'nav'        => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'footer'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'section'    => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'br'     => array(),
		'em'     => array(),
		'i'      => array(),
		'strong' => array(),
		'b'      => array(),
		'u'      => array(),
		'font'   => array()
	);

	/**
	 * Limited HTML
	 * Used for sanitization where only limited HTML is needed
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @access private
	 */
	private $limited_html = array(
		'a'      => array(
			'href'       => array(),
			'title'      => array(),
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'em'     => array(),
		'strong' => array(),
	);

	/**
	 * Adds admin page
	 * Adds admin scripts and styles
	 * 
	 * Uses page data to ensure that admin styles and scripts only added to new admin page
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function add_admin_page() {

		// Edit template admin page
		$page = add_theme_page(
			__( 'Edit template', 'wppb_lang' ), 
			__( 'Edit template', 'wppb_lang' ), 
			'edit_theme_options', 
			'edit_template', 
			array( $this, 'admin_page_contents' )
		);
		add_action( 'admin_print_styles-' . $page, array( $this, 'admin_styles' ) ); // Add styles (only for this admin page)
		add_action( 'admin_print_styles-' . $page, array( $this, 'admin_scripts' ) );

		// Register a new WordPress option
		register_setting( 'pressabl', PRESSABL_FUNCTIONS );
	}

	/**
	 * Add scripts
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function admin_scripts() {
		wp_register_script(
			'jquery-admin',
			get_template_directory_uri() . '/scripts/admin.js',
			array( 'jquery' ),
			'1.0'
		);
		wp_enqueue_script( 'jquery-ui-tabs' ); // Adds support for tabber menus
		wp_enqueue_script( 'jquery-admin' ); // Creates tabber menu
	}

	/**
	 * Add stylesheet
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function admin_styles() {
		wp_enqueue_style( 'wppb-admin-css', get_template_directory_uri() . '/admin.css', false, '', 'screen' );
	}

	/**
	 * Save / Publish data
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function store_data( $data ) {

		// If no data array, then bail out now
		if ( !is_array( $data ) )
			return;

		// Set post status
		if ( isset( $data['draft'] ) )
			$post_status = 'draft';
		elseif ( isset( $data['publish'] ) )
			$post_status = 'publish';
		else
			return;

		// Set any variables which may be empty
		if ( empty( $data['thumbnail_hardcrop'] ) )
			$data['thumbnail_hardcrop'] = false;

		// Process data
		$secondary = $this->sanitize_templates( $data[PRESSABL_TEMPLATES] );

		$thumbs    = $this->process_thumbnails( $data['thumbnail_name'], $data['thumbnail_width'], $data['thumbnail_height'], $data['thumbnail_hardcrop'] );
		$thumbs    = $this->sanitize_thumbnails( $thumbs );

		$widgets   = $this->process_widgets( $data['name_widget'], $data['description_widget'], $data['before_widget'], $data['after_widget'], $data['before_title'], $data['after_title'] );
		$widgets   = $this->sanitize_widgets( $widgets );

		$menus     = $this->process_menus( $data['name_menu'] );
		$menus     = $this->sanitize_menus( $menus );

		// Place primary settings into an array
		$primary = array(
			'widgets' => $widgets,
			'thumbs'  => $thumbs,
			'menus'   => $menus,
		);

		// Cache primary settings in an option (can be accessed faster as an option - useful since this data is accessed on every page load)
		if ( 'publish' == $post_status )
			update_option( PRESSABL_FUNCTIONS, $primary );

		// Stash content into another array and serialise it
		$post_content = array(
			'primary'   => $primary,
			'secondary' => $secondary,
		);
		$post_content = serialize( $post_content );

		// Create post object
		$pressabl = array(
			'post_content' => $post_content,
			'post_type'    => 'pressabl',
			'post_status'  => $post_status,
		);

		// Insert the post into the database
		$post_id = wp_insert_post( $pressabl );

		// Delete old posts
		$args = array(
			'post_type'    => 'pressabl',
			'numberposts'  => ( PRESSABL_REVISIONS + 1 ),
			'post_status'  => $post_status,
		);
		$posts = get_posts( $args ); // Grab posts as array
		if ( isset( $posts[PRESSABL_REVISIONS] ) ) {
			$post = $posts[PRESSABL_REVISIONS]; // Grab last post
			$post_id = $post->ID; // Set the post ID
			$count_posts = wp_count_posts( 'pressabl' ); // Count the number of posts

			// Only delete post if it exists
			if ( $count_posts->$post_status > PRESSABL_REVISIONS )
				wp_delete_post( $post_id ); // Delete post
		}

	}

	/**
	 * Register the theme initially
	 * Sets theme settings
	 * 
	 * ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ THIS METHOD NEEDS LOTS OF WORK >>>>>>>>>>
	 * 
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	function register_theme() {
//return;

		// Saving data to file
		// Grabbing post data from DB
		$args = array(
			'post_type'    => 'pressabl',
			'numberposts'  => 1,
			'post_status'  => 'Publish',
		);
		$posts   = get_posts( $args ); // Grab posts as array
		$post    = $posts[0]; // Select the desired revision (substract one as array starts at zero)
		$content_raw = $post->post_content; // Grab post content
		$content = unserialize( $content_raw ); // Unserialize the array
		$save_data = serialize( $content );
		file_put_contents( get_template_directory() . '/data.tpl', $save_data );


		// Grabbing data file from storage
		$data_raw = file_get_contents( get_template_directory() . '/data.tpl' );
		$data = unserialize( $data_raw );

		$primary = $data['primary'];
		$secondary = $data['secondary'];

		// Zip through the stuff in the primary array and sanitize accordingly
		foreach( $primary as $key => $value ) {
			if ( 'widgets' == $key )
				$primary['widgets'] = $this->sanitize_widgets( $value );				
			if ( 'thumbs' == $key )
				$primary['thumbs'] = $this->sanitize_thumbnails( $value );				
			if ( 'menus' == $key )
				$primary['menus'] = $this->sanitize_menus( $value );				
		}
		
		// Sanitize stuff in secondary array as templates
		$secondary = $this->sanitize_templates(  $secondary );
		
		// Recombine into single array
		$data['primary'] = $primary;
		$data['$secondary'] = $secondary;

		return;
	}


	/**
	 * Output admin page contents
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * echo string
	 */
	public function admin_page_contents() {

		// Do nonce security check
		if ( !empty( $_POST ) && check_admin_referer( 'pressabl-action', 'pressabl' ) ) {
			// If form submitted, then process form data
			$this->store_data( $_POST );
		}

		?>
<div class="wrap"><?php
	// Create screen icon by heading
	screen_icon( 'pressabl-icon' );

	// Set draft publish status's
	if ( isset( $_GET['pressabl-save'] ) )
		$save = $_GET['pressabl-save'];
	else
		$save = 'publish';


	// Page heading
	echo '<h2>';
	echo wp_get_theme();
	if ( isset( $_GET['pressabl-revision'] ) || ( 'draft' == $save ) ) {
		echo ' : Revision number ' . $_GET['pressabl-revision'];
		if ( 'draft' == $save )
			echo ' (saved draft)';
	}
	echo '</h2>';

	// Setting preview state
	if ( isset( $_GET['pressabl-preview'] ) )
		$preview = 'true';
	else
		$preview = 'false';


	// Set revision state
	if ( isset( $_GET['pressabl-revision'] ) )
		$revision = $_GET['pressabl-revision'];
	else
		$revision = 1;

	
	
	
	
	// "Options Saved" message as displayed at top of page on clicking "Save"
	if ( isset( $_REQUEST['updated'] ) )
		echo '<div class="updated fade"><p><strong>' . __( 'Options saved' ) . '</strong></p></div>';

	?>
	<form method="post" action="<?php echo admin_url( 'themes.php?page=edit_template' ); ?>"><?php

		// Add nonce for security
		wp_nonce_field(
			'pressabl-action', // Unique identifier
			'pressabl',        // Nonce name
			true,              // Add referrer field
			true               // echo it
		);

		?>
		<div id="pressabl-tabs">
			<ul>
				<li id="pressabl-css-options"><a href="#css-options"><span><?php _e( 'CSS', 'pixopoint_theme_editor' ); ?></span></a></li>
				<li id="pressabl-extras-options"><a href="#extras-options"><span><?php _e( 'Extras', 'pixopoint_theme_editor' ); ?></span></a></li>
				<li id="pressabl-includes-options"><a href="#includes-options"><span><?php _e( 'Includes', 'pixopoint_theme_editor' ); ?></span></a></li>
				<li id="pressabl-index-options"><a href="#index-options"><span><?php _e( 'Main', 'pixopoint_theme_editor' ); ?></span></a></li>
				<li id="pressabl-blog-options"><a href="#blog-options"><span><?php _e( 'Blog', 'pixopoint_theme_editor' ); ?></span></a></li>
				<li id="pressabl-archives-options"><a href="#archives-options"><span><?php _e( 'Archive', 'pixopoint_theme_editor' ); ?></span></a></li>
				<li id="pressabl-pages-options"><a href="#pages-options"><span><?php _e( 'Page', 'pixopoint_theme_editor' ); ?></span></a></li>
			</ul>
	
			<div id="css-options">
				<div class="tab-inner">
					<h3><?php _e( 'CSS styling code', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea id="code" name="<?php echo PRESSABL_TEMPLATES; ?>[css]" value=""><?php echo get_pressabl_option( 'css' ); ?></textarea>
					</p>
				</div>
			</div>
	
			<div id="extras-options">
				<div class="tab-inner">

					<h3><?php _e( 'Post thumbnails', 'pixopoint_theme_editor' ); ?></h3>	
					<table class="widefat">
						<thead>
							<tr>
								<th>
									<label><?php _e( 'Name', 'pixopoint_theme_editor' ); ?></label>
								</th>
								<th>
									<label><?php _e( 'Width', 'pixopoint_theme_editor' ); ?></label>
								</th>
								<th>
									<label><?php _e( 'Height', 'pixopoint_theme_editor' ); ?></label>
								</th>
								<th class="hard-crop">
									<label><?php _e( 'Hard crop?', 'pixopoint_theme_editor' ); ?></label>
								</th>
							</tr>
						</head>
						<tfoot> 
							<tr> 
								<th scope="col" colspan="5">
									<?php _e( 'Thumbnail names specified here will become available for use in templates.', 'pixopoint_theme_editor' ); ?>
								</th> 
							</tr> 
						</tfoot> 
						<tbody class="plugins"><?php

					// Load thumbnail settings (for add_image_size();)
					$thumbs = (array) get_pressabl_option( 'thumbs' );

					// Set a blank array, to ensure that at least one blank item is present (allows people to add more thumbnails later)
					$thumbnails_extra = array(
						0 => array(
							'name'      => '',
							'width'     => '',
							'height'    => '',
							'hardcrop'  => '',
						),
					);
					$thumbs = array_merge( $thumbs, $thumbnails_extra ); // Merging blank array with pre-populated array (or potentially blank array if no thumbnails have been set)

					$blank = false; // Setting the 'blank' var (used for ensuring that only a single blank variable is listed)
					foreach ( $thumbs as $key => $thumb ) {
					
						// If blank is set, and no thumbnail specified, then skip
						if ( true == $blank && '' == $thumb['name'] )
							continue;

						// If no name set, then set $blank to ensure that no more blank items are listed (no point in having a ton of empty thumbnails set)
						if ( '' == $thumb['name'] )
							$blank = true;

						// Spit out the form markup
						echo '<tr>';
						echo '<td><input type="text" name="thumbnail_name[' . $key . ']" value="' . $thumb['name'] . '" /></td>';
						echo '<td><input type="text" name="thumbnail_width[' . $key . ']" value="' . (int) $thumb['width'] . '" /></td>';
						echo '<td><input type="text" name="thumbnail_height[' . $key . ']" value="' . (int) $thumb['height'] . '" /></td>';
						echo '<td class="hard-crop"><input type="checkbox" name="thumbnail_hardcrop[' . $key . ']" value="true" ';
						checked( $thumb['hardcrop'], true );
						echo '/></td>';
						echo '</tr>';
					}

					?>
						</tbody>
					</table>
	
					<h3><?php _e( 'Widget areas', 'pixopoint_theme_editor' ); ?></h3>
					<table class="widefat">
						<thead>
							<tr>
								<th>
									<label><?php _e( 'Name', 'pixopoint_theme_editor' ); ?></label>
								</th>
								<th>
									<label><?php _e( 'Description', 'pixopoint_theme_editor' ); ?></label>
								</th>
								<th>
									<label><?php _e( 'Before widget', 'pixopoint_theme_editor' ); ?></label>
								</th>
								<th>
									<label><?php _e( 'After widget', 'pixopoint_theme_editor' ); ?></label>
								</th>
								<th>
									<label><?php _e( 'Before title', 'pixopoint_theme_editor' ); ?></label>
								</th>
								<th>
									<label><?php _e( 'After title', 'pixopoint_theme_editor' ); ?></label>
								</th>
							</tr>
						</head>
						<tfoot> 
							<tr> 
								<th scope="col" colspan="5">
									<?php _e( 'Widget area names specified here will become available on the <a href="' . admin_url( '/widgets.php' ) . '">widgets page</a>.', 'pixopoint_theme_editor' ); ?>
								</th> 
							</tr> 
						</tfoot> 
						<tbody class="plugins"><?php

					// Load thumbnail settings (for add_image_size();)
					$widgets = (array) get_pressabl_option( 'widgets' );

					// Set a blank array, to ensure that at least one blank item is present (allows people to add more thumbnails later)
					$widgets_extra = array(
						0 => array(
							'name_widget'        => '',
							'description_widget' => '',
							'before_widget'      => '',
							'after_widget'       => '',
							'before_title'       => '',
							'after_title'        => '',
						),
					);
					$widgets = array_merge( $widgets, $widgets_extra ); // Merging blank array with pre-populated array (or potentially blank array if no thumbnails have been set)

					$blank = false; // Setting the 'blank' var (used for ensuring that only a single blank variable is listed)
					foreach ( $widgets as $key => $widget ) {
					
						// If blank is set, and no $widget specified, then skip
						if ( true == $blank && '' == $widget['name_widget'] )
							continue;

						// If no name set, then set $blank to ensure that no more blank items are listed (no point in having a ton of empty thumbnails set)
						if ( '' == $widget['name_widget'] )
							$blank = true;

						// Spit out the form markup
						echo '<tr>';
						echo '<td><input type="text" name="name_widget[' . $key . ']" value="' . $widget['name_widget'] . '" /></td>';
						echo '<td><textarea type="text" name="description_widget[' . $key . ']">' . $widget['description_widget'] . '</textarea></td>';
						echo '<td><textarea type="text" name="before_widget[' . $key . ']">' . $widget['before_widget'] . '</textarea></td>';
						echo '<td><textarea type="text" name="after_widget[' . $key . ']">' . $widget['after_widget'] . '</textarea></td>';
						echo '<td><textarea type="text" name="before_title[' . $key . ']">' . $widget['before_title'] . '</textarea></td>';
						echo '<td><textarea type="text" name="after_title[' . $key . ']">' . $widget['after_title'] . '</textarea></td>';
						echo '</tr>';
					}

					?>
						</tbody>
					</table>

					<h3><?php _e( 'Menus', 'pixopoint_theme_editor' ); ?></h3>
					<table class="widefat pressabl-menus">
						<thead>
							<tr>
								<th>
									<label><?php _e( 'Menu name', 'pixopoint_theme_editor' ); ?></label>
								</th>
							</tr>
						</head>
						<tfoot> 
							<tr> 
								<th scope="col" colspan="5">
									<?php _e( 'Menu names specified here will become available on the <a href="' . admin_url( '/nav-menus.php' ) . '">menus page</a>.', 'pixopoint_theme_editor' ); ?>
								</th> 
							</tr> 
						</tfoot> 
						<tbody class="plugins"><?php

					// Load thumbnail settings (for add_image_size();)
					$menus = (array) get_pressabl_option( 'menus' );

					// Set a blank array, to ensure that at least one blank item is present (allows people to add more thumbnails later)
					$menus_extra = array(
						0 => array(
							'name_menu'    => '', // Kept as a key value array for forwards compatibility reasons (in case we want to add more options to each menu later on)
						),
					);
					$menus = array_merge( $menus, $menus_extra ); // Merging blank array with pre-populated array (or potentially blank array if no thumbnails have been set)

					$blank = false; // Setting the 'blank' var (used for ensuring that only a single blank variable is listed)
					foreach ( $menus as $key => $menu ) {

						// If blank is set, and no $widget specified, then skip
						if ( true == $blank && '' == $menu['name_widget'] )
							continue;

						// If no name set, then set $blank to ensure that no more blank items are listed (no point in having a ton of empty thumbnails set)
						if ( '' == $menu['name_menu'] )
							$blank = true;

						// Spit out the form markup
						echo '<tr><td><input type="text" name="name_menu[' . $key . ']" value="' . $menu['name_menu'] . '" /></td></tr>';
					}

					?>
						</tr>
					</table>
				</div>
			</div>

			<div id="includes-options">
				<div class="tab-inner">
	
					<h3><?php _e( 'Header template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper medium">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?>[header]" value=""><?php echo get_pressabl_option( 'header' ); ?></textarea>
					</p>
	
					<h3><?php _e( 'Footer template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper medium">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?>[footer]" value=""><?php echo get_pressabl_option( 'footer' ); ?></textarea>
					</p>
	
					<h3><?php _e( 'Comments', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper medium">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?>[comments]" value=""><?php echo get_pressabl_option( 'comments' ); ?></textarea>
					</p>
	
				</div>
			</div>
	
			<div id="index-options">
				<div class="tab-inner">
					<h3><?php _e( 'Index page template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?>[index]" value=""><?php echo get_pressabl_option( 'index' ); ?></textarea>
					</p>
					<h3><?php _e( 'Front page template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?>[front_page]" value=""><?php echo get_pressabl_option( 'front_page' ); ?></textarea>
					</p>
				</div>
			</div>

			<div id="pages-options">
				<div class="tab-inner">
					<h3><?php _e( 'Default page template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?>[page]" value=""><?php echo get_pressabl_option( 'page' ); ?></textarea>
					</p>
	
					<h3><?php _e( 'Page template 1', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper medium">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?>[page_template_1]" value=""><?php echo get_pressabl_option( 'page_template_1' ); ?></textarea>
					</p>
	
					<h3><?php _e( 'Page template 2', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper medium">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?><?php echo PRESSABL_TEMPLATES
; ?>[page_template_2]" value=""><?php echo get_pressabl_option( 'page_template_2' ); ?></textarea>
					</p>
				</div>
			</div>

			<div id="blog-options">
				<div class="tab-inner">
					<h3><?php _e( 'Single post template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?>[single]" value=""><?php echo get_pressabl_option( 'single' ); ?></textarea>
					</p>
					<h3><?php _e( 'Blog page template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?>[home]" value=""><?php echo get_pressabl_option( 'home' ); ?></textarea>
					</p>
				</div>
			</div>
	
			<div id="archives-options">
				<div class="tab-inner">
					<h3><?php _e( 'Archive template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo PRESSABL_TEMPLATES
; ?>[archive]" value=""><?php echo get_pressabl_option( 'archive' ); ?></textarea>
					</p>
				</div>
			</div>

		</div>
	<p class="submit" style="float:left;margin:25px 0 0 0;">

		<input type="submit" class="button-primary" name="publish" value="<?php _e( 'Publish', 'pixopoint_theme_editor' ); ?>" />
		<input type="submit" class="button button-highlighted" name="draft" value="<?php _e( 'Save Draft', 'pixopoint_theme_editor' ); ?>" />

<?php
/********************************************************
 ********************************************************
 ***** CLEAN UP SYNTAX HERE *****************************
 ********************************************************
 ********************************************************
 */


	?>
		<a class="button" href="<?php echo esc_url( home_url( '/?pressabl-preview=' . $preview . '&pressabl-revision=' . $revision ) ) ; ?>">
			<?php _e( 'Preview', 'pixopoint_theme_editor' ); ?>
		</a>

		<select name="pressabl-revisions" id="pressabl-revisions">
			<option disabled="disabled"><?php _e( 'Choose a revision', 'pixopoint_theme_editor' ); ?></option><?php
			$count = 1;



			// Iterate through all the revisions
			while( $count < PRESSABL_REVISIONS ) {

				// 
				if ( $revision == $count )
					$selected = 'SELECTED ';
				else
					$selected = '';

				// Output options field to screen
				echo '<option ' . $selected . 'value="' . esc_url( admin_url( '/themes.php?page=edit_template&pressabl-preview=' . $preview . '&pressabl-revision=' . $count ) ) . '">Revision ' . $count . '</option>';

				// Iterate through
				$count++;
			}
		?>
		</select>

		<select name="pressabl-preview" id="pressabl-preview">
			<?php
			$draft = '';
			$publish = '';

			if ( 'draft' == $save)
				$draft = ' SELECTED ';
			else
				$publish = ' SELECTED ';
			?>
			<option <?php echo $publish; ?>value="<?php echo admin_url( '/themes.php?page=edit_template&pressabl-save=publish&pressabl-revision=' . $revision ); ?>"><?php _e( 'Publish', 'pixopoint_theme_editor' ); ?></option>
			<option <?php echo $draft; ?>value="<?php echo admin_url( '/themes.php?page=edit_template&pressabl-save=draft&pressabl-revision=' . $revision ); ?>"><?php _e( 'Draft', 'pixopoint_theme_editor' ); ?></option>
		</select>

	</p>
</form>
</div><?php

	}

	/**
	 * Add dashboard widgets
	 * 
	 * @since 0.8.6
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function admin_add_dashboard_widgets() {
		
		// Add custom WP Paintbrush feed
		wp_add_dashboard_widget(
			'wpbp_dashboard_custom_feed',
			__( 'Latest Posts from WP Paintbrush', 'wppb_lang' ),
			array( $this, 'dashboard_custom_feed_output' )
		);
	}
	
	/**
	 * New dashboard widget
	 * Creates the custom dashboard feed RSS box
	 * 
	 * @since 0.8.6
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * echo string
	 */
	public function dashboard_custom_feed_output() {
		
		echo '<div class="rss-widget" id="wppb-rss-widget">';
		wp_widget_rss_output(
			array(
				'url'           => 'http://wppaintbrush.com/feed/',
				'title'         => __( 'News from WP Paintbrush', 'wppb_lang' ),
				'items'         => 3,
				'show_summary'  => 1,
				'show_author'   => 0,
				'show_date'     => 1
			)
		);
		echo '</div>';
	}

	/**
	 * Process post thumbnail form inputs
	 * Accepts an array, returns an array
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @access private
	 * @param string $name
	 * @param    int $width
	 * @param    int $height
	 * @param   bool $hardcrop
	 * @return array
	 */
	private function process_thumbnails( $name, $width=100, $height=100, $hardcrop=FALSE ) {

		// If no post sent, then bail out now
		if ( empty( $name ) )
			return;

		// Set vars
		$thumbnails = array();

		// Iterate through every name
		foreach( $name as $key => $value ) {

			// If name is blank, then continue (thumbnails with no name are useless, hence we ignore them)
			if ( '' == $name[$key] )
				continue;

			// Set the array
			$thumbnails[$key] = array(
				'name'     => $name[$key],
				'width'    => $width[$key],
				'height'   => $height[$key],
				'hardcrop' => $hardcrop[$key],
			);
		}

		// Return the final processed array
		return $thumbnails;
	}

	/**
	 * Sanitize post thumbnail data
	 * Accepts an array, returns a sanitized array
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @access private
	 * @param array $thumbs_input
	 * return array
	 */
	private function sanitize_thumbnails( $thumbs_input ) {

		$thumbs_output  = array();
		$thumb_output  = array();
		$thumb_temp    = array();
		$thumb_content = array();

		// Iterate through every name
		foreach( $thumbs_input as $key => $thumb ) {

			// Need to process the inner array
			foreach( $thumb as $label => $value ) {

				// Sanitize data
				switch ( $label ) {
					case 'name':     $value = sanitize_title( $value ); break; // Sanitize name
					case 'width':    $value = (int) abs( $value );      break; // Sanitize width
					case 'height':   $value = (int) abs( $value );      break; // Sanitize height
					case 'hardcrop': $value = (bool) $value;            break; // Sanitize hard cropping
				}

				// Create temporary array for addition to $widgets
				$thumb_temp = array(
					$label => $value, // Sanitize the value
				);
				$thumb_content = array_merge( $thumb_content, $thumb_temp ); // Adding tmporary array to main array
			}
			$thumbs_output[$key] = $thumb_content; // Setting single widget as array
		}

		return $thumbs_output;
	}

	/**
	 * Process widget form inputs
	 * Accepts an array, returns an array
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @param string $name_widget
	 * @param string $description_widget
	 * @param string $before_widget
	 * @param string $after_widget
	 * @param string $before_title
	 * @param string $after_title
	 * @return array
	 */
	private function process_widgets( $name_widget, $description_widget, $before_widget, $after_widget, $before_title, $after_title ) {

		// If no post sent, then bail out now
		if ( empty( $name_widget ) )
			return;

		// Set vars
		$widgets = array();

		// Iterate through every name
		foreach( $name_widget as $key => $value ) {

			// If name is blank, then continue (thumbnails with no name are useless, hence we ignore them)
			if ( '' == $name_widget[$key] )
				continue;

			// Set the array
			$widgets[$key] = array(
				'name_widget'        => $name_widget[$key],
				'description_widget' => $description_widget[$key],
				'before_widget'      => $before_widget[$key],
				'after_widget'       => $after_widget[$key],
				'before_title'       => $before_title[$key],
				'after_title'        => $after_title[$key],
			);
		}

		// Return the final processed array
		return $widgets;
	}

	/**
	 * Sanitizes widget data
	 * Accepts an array, returns a sanitized array
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @param array $widgets_input
	 * @return array
	 */
	private function sanitize_widgets( $widgets_input ) {
		$widgets_output = array();
		$widget_output  = array();
		$widget_temp    = array();
		$widget_content = array();

		// Iterate through every name
		foreach( $widgets_input as $key => $widget ) {

			// Need to process the inner array
			foreach( $widget as $label => $value ) {
				switch ( $label ) {
					case 'name_widget':        $value = sanitize_title( $value );                   break;
					case 'description_widget': $value = wp_kses( $value, $this->allowed_html, '' ); break;
					case 'before_widget':      $value = wp_kses( $value, $this->allowed_html, '' ); break;
					case 'after_widget':       $value = wp_kses( $value, $this->allowed_html, '' ); break;
					case 'before_title':       $value = wp_kses( $value, $this->allowed_html, '' ); break;
					case 'after_title':        $value = wp_kses( $value, $this->allowed_html, '' ); break;
				}

				// Create temporary array for addition to $widgets
				$widget_temp = array(
					$label => $value, // Sanitize the value
				);
				$widget_content = array_merge( $widget_content, $widget_temp ); // Adding tmporary array to main array
			}
			$widgets_output[$key] = $widget_content; // Setting single widget as array
		}

		return $widgets_output;
	}

	/**
	 * Sanitize menu inputs
	 * Accepts an array, returns a sanitized array
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @access private
	 * @param $name_menu
	 * @return array
	 */
	private function process_menus( $name_menu ) {

		// If no post sent, then bail out now
		if ( empty( $name_menu ) )
			return;

		// Set vars
		$menus = array();

		// Iterate through every name
		foreach( $name_menu as $key => $value ) {

			// If name is blank, then continue (thumbnails with no name are useless, hence we ignore them)
			if ( '' == $name_menu[$key] )
				continue;

			// Set the array
			$menus[$key] = array(
				'name_menu'   => $name_menu[$key],
			);
		}

		// Return the final processed array
		return $menus;
	}

	/**
	 * Sanitize menu inputs
	 * Accepts an array, returns a sanitized array
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @access private
	 * @param array $menus
	 * @return array
	 */
	private function sanitize_menus( $menus = array() ) {

		// Iterate through every name
		foreach( $menus as $key => $value ) {
			// Need to process the inner array
			foreach( $value as $menu_name ) {
				// Reset the array
				$menus[$key] = array(
					'name_menu' => sanitize_title( $menu_name ), // Sanitize the value
				);
			}
		}

		// Return the final processed array
		return $menus;
	}

	/**
	 * Sanitize form inputs
	 * Accepts an array, returns a sanitized array
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @access private
	 * @param array $templates
	 * @return array
	 */
	private function sanitize_templates( $templates ) {

		// If no template argument, then bail out now
		if ( empty( $templates ) )
			return;

		// Sanitize numbers
		if ( !isset( $functions['version'] ) )
			$functions['version'] = '';
		if ( is_numeric( $functions['version'] ) )
			$output_functions['version'] = intval( $functions['version'] );

		// Sanitize template markup
		$template = array( 
			'header',
			'footer',
			'index',
			'front_page',
			'home',
			'page',
			'page_template_1',
			'page_template_2',
			'single',
			'comments',
		);
		foreach ( $template as $thingy ) {
			if ( !isset( $templates[$thingy] ) )
				$templates[$thingy] = '';
			$output_templates[$thingy] = wp_kses( $templates[$thingy], $this->allowed_html, '' );
		}

		// Sanitize CSS
		$output_templates['css'] = $this->validate_css( $templates['css'] );

		// Support for plain strings instead of arrays
		if ( !is_array( $templates ) )
			$output_templates = wp_kses( $templates, $this->allowed_html, '' );

		// Finally - return the santised output
		return $output_templates;
	}

	/**
	 * Serve error if running PHP older than version 5.2
	 * 
	 * @since 0.5
	 * author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function php5_2_error_message() {
		if ( version_compare( phpversion(), '5.2', '<' ) ) {
			echo '
			<div id="message" class="updated fade" style="opacity:1;">
				<p>
					Sorry, but this theme only supports php 5.2 or above. Some features may or may not work as expected.
				</p>
			</div>';
		}
	}

	/**
	 * CSS validation
	 * Much of this code is courtesy of SafeCSS by Automattic and CSSTidy
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @param string $css
	 * @return string
	 */
	private function validate_css( $css ) {
	
		// SafeCSS / CSSTidy stuff
		$csstidy = new csstidy();
		$csstidy->optimise = new safecss( $csstidy );
		$csstidy->set_cfg( 'remove_bslash', false );
		$csstidy->set_cfg( 'compress_colors', false );
		$csstidy->set_cfg( 'compress_font-weight', false );
		$csstidy->set_cfg( 'discard_invalid_properties', true );
		$csstidy->set_cfg( 'merge_selectors', false );
		$csstidy->set_cfg( 'preserve_css', true ); // Outputs code comments
	
		// $csstidy->set_cfg( 'lowercase_s', false );
		// $csstidy->set_cfg( 'optimise_shorthands', 1 );
		// $csstidy->set_cfg( 'remove_last_;', false );
		// $csstidy->set_cfg( 'case_properties', 1 );
		// $csstidy->set_cfg( 'sort_properties', false );
		// $csstidy->set_cfg( 'sort_selectors', false );
	
		// Santisation stuff copied from SafeCSS by Automattic
		$css = stripslashes( $css );
		$css = preg_replace( '/\\\\([0-9a-fA-F]{4})/', '\\\\\\\\$1', $prev = $css );
		$css = str_replace( '<=', '&lt;=', $css ); // Some people put weird stuff in their CSS, KSES tends to be greedy
		$css = wp_kses_split( $prev = $css, array(), array() ); // Why KSES instead of strip_tags?  Who knows?
		$css = str_replace( '&gt;', '>', $css ); // kses replaces lone '>' with &gt;
		$css = strip_tags( $css ); // Why both KSES and strip_tags?  Because we just added some '>'.
	
		// Parse with CSS tidy
		$csstidy->parse( $css ); // Parse with CSS Tidy
		$css = $csstidy->print->plain(); // Grab CSS output
	
		/**
		 * Make the CSS pretty
		 * This code is quite crude, but it works fine and it's not hideously inefficient so we'll do for the mean time :)
		 * @since 0.9
		 */
		$css = preg_replace( '/\n/', '', $css ); // Stripping carriage returns
		$css = str_replace( ';', ';
	', $css ); // Add carriage return after ";"
		$css = str_replace( '!important;', ' !important;', $css ); // Adding space back in before !important declaration
		//$css = str_replace( '#suckerfishnav', '.pixopoint', $css ); // Legacy support for CSS generator and older PixoPoint plugins
		$css = str_replace( '
	}', '
}
', $css ); // Remove tab before and carriage return after "}"
		$css = str_replace( '{', '{
	', $css ); // Add carriage return and tab after "{"
		$css = str_replace( '*/', '*/
', $css ); // Add carriage return after code comment
		$css = str_replace( '/*', '
/*', $css ); // Add two carriage returns before code comment
	
		// Code Comments
		$css = str_replace( "}/*", "}\n/*", $css ); // Prevents comments showing up immediately after { symbol
	
		// Nested brace correction
		$css = str_replace( "}
}", "	}\n}", $css ); // Indents first brace
	
		$css = explode( '{', $css ); // The following is hideous code - but it works so will probably remain here until some kind sole offers to rewrite it
		foreach( $css as $piece=>$chunk ) {
			if ( !isset( $count ) )
				$count = '';
			if ( $count == 0 ) {
				$chunk = explode( '}', $chunk );
				if ( !isset( $chunk[1] ) )
					$chunk[1] = '';
				$chunk[1] = str_replace( ',', ',
', $chunk[1] ); // Adds carriage return after comma - doesn't work with first line
				$chunk[0] = str_replace( ':', ': ', $chunk[0] ); // Add spaces after colons - needs to be here to avoid messing up pseudo-classes
				//$chunk[0] = str_replace( ',', ',', $chunk[0] ); // Add space after comma - mainly for font-family declarations - doesn't work
				$chunk = implode( '}', $chunk );
				$count = -1;
			}
			$css[$piece] = $chunk;
			$count ++;
		}
		$css = implode( '{', $css );
		$css = str_replace( '}{', '{', $css ); // Nasty hack to fix "{}" code bug
		$css = substr( $css, 0, -1 ); // Nasty hack to remove final "}"
		
		return $css;
	}
	
}
