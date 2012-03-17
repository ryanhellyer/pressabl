<?php
/**
 * @package WordPress
 * @subpackage WP Paintbrush theme
 * @since WP Paintbrush 0.1
 *
 * Admin pages
 */


/**
 * Do not continue processing since file was called directly
 * @since 0.1
 */
if ( !defined( 'ABSPATH' ) )
	die( 'Eh! What you doin in here?' );

/**
 * Pressabl admin pages
 * 
 * @copyright Copyright (c), PixoPoint
 * @license http://www.gnu.org/licenses/gpl.html GPL
 * @author Ryan Hellyer <ryan@pixopoint.com>
 * @since 1.0
 */
class Pressabl_Admin {
	
	/**
	 * Constructor
	 * Add methods to appropriate hooks and filters
	 * 
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function __construct() {
		add_filter( 'gallery_style', array( $this, 'settings_remove_gallery_css' ) );
		add_action( 'admin_menu', array( $this, 'edit_options_add_page' ) );
		add_action( 'wp_dashboard_setup', array( $this, 'admin_add_dashboard_widgets' ) );
		add_action( 'admin_notices', array( $this, 'php5_2_error_message' ) );
	}
	
	/**
	 * Allowed HTML
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
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
		'pre'      => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'tr'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
			'td'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'th'     => array(
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
		'ul'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'li'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'ol'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'img'     => array(
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
		'aside'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'header'     => array(
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'nav'     => array(
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
	 */
	private $limited_html = array(
		'a'      => array(
			'href'      => array(),
			'title'     => array(),
			'style'      => array(),
			'class'      => array(),
			'id'         => array()
		),
		'em'     => array(),
		'strong' => array(),
	);
	
	/**
	 * Load up the menu pages
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function edit_options_add_page() {
	
		// Edit template admin page
		$page = add_theme_page(
			__( 'Edit template' ), 
			__( 'Edit template' ), 
			'edit_theme_options', 
			'edit_template', 
			array( $this, 'edit_template_do_page' )
		);
		add_action( 'admin_print_styles-' . $page, array( $this, 'settings_admin_styles' ) ); // Add styles (only for this admin page)
		add_action( 'admin_print_styles-' . $page, array( $this, 'settings_admin_scripts' ) );
		
	}

	/**
	 * Add scripts
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function settings_admin_scripts() {
		wp_register_script(
			'jquery-tabber',
			get_template_directory_uri() . '/scripts/tabber.js',
			array( 'jquery' ),
			'1.0'
		);
		wp_enqueue_script( 'jquery-ui-tabs' ); // Adds support for tabber menus
		wp_enqueue_script( 'jquery-tabber' ); // Creates tabber menu
	}
	
	/**
	 * Add stylesheet
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 */
	public function settings_admin_styles() {
		wp_enqueue_style( 'wppb-admin-css', get_template_directory_uri() . '/admin.css', false, '', 'screen' );
	}

	/**
	 * Create the options page
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * echo string
	 */
	public function edit_template_do_page() {

		// If form submitted, then process form data
		if ( isset( $_POST['name_menu'] ) ) {

			// Do nonce security check
			//check_admin_referer( 'pressabl' );

			// Process data
			$templates = $this->process_templates();
			$thumbs    = $this->process_thumbnails();
			$widgets   = $this->process_widgets();
			$menus     = $this->process_menus();
			$output_functions = array(
				'thumbs'  => $thumbs,
				'widgets' => $widgets,
				'menus'   => $menus,
			);

			// Stash dat shit in the DB
			update_option( WPPB_FUNCTIONS, $output_functions );
			update_option( WPPB_TEMPLATES, $templates );
		}
		?>
<div class="wrap"><?php
	// Create screen icon by heading
	screen_icon( 'pressabl-icon' );

	// Page heading
	echo '<h2>' . get_current_theme() . '</h2>';
	
	// "Options Saved" message as displayed at top of page on clicking "Save"
	if ( isset( $_REQUEST['updated'] ) )
		echo '<div class="updated fade"><p><strong>' . __( 'Options saved' ) . '</strong></p></div>';

	?>
	<form method="post" action="">

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
						<textarea id="code" name="<?php echo WPPB_TEMPLATES; ?>[css]" value=""><?php echo get_wppb_option( 'css' ); ?></textarea>
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
					$thumbs = (array) get_wppb_option( 'thumbs' );

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
					$widgets = (array) get_wppb_option( 'widgets' );

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
					$menus = (array) get_wppb_option( 'menus' );

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
						<textarea name="<?php echo WPPB_TEMPLATES; ?>[header]" value=""><?php echo get_wppb_option( 'header' ); ?></textarea>
					</p>
	
					<h3><?php _e( 'Footer template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper medium">
						<textarea name="<?php echo WPPB_TEMPLATES; ?>[footer]" value=""><?php echo get_wppb_option( 'footer' ); ?></textarea>
					</p>
	
					<h3><?php _e( 'Comments', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper medium">
						<textarea name="<?php echo WPPB_TEMPLATES; ?>[comments]" value=""><?php echo get_wppb_option( 'comments' ); ?></textarea>
					</p>
	
				</div>
			</div>
	
			<div id="index-options">
				<div class="tab-inner">
					<h3><?php _e( 'Index page template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo WPPB_TEMPLATES; ?>[index]" value=""><?php echo get_wppb_option( 'index' ); ?></textarea>
					</p>
					<h3><?php _e( 'Front page template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo WPPB_TEMPLATES; ?>[front_page]" value=""><?php echo get_wppb_option( 'front_page' ); ?></textarea>
					</p>
				</div>
			</div>

			<div id="pages-options">
				<div class="tab-inner">
					<h3><?php _e( 'Default page template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo WPPB_TEMPLATES; ?>[page]" value=""><?php echo get_wppb_option( 'page' ); ?></textarea>
					</p>
	
					<h3><?php _e( 'Page template 1', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper medium">
						<textarea name="<?php echo WPPB_TEMPLATES; ?>[page_template_1]" value=""><?php echo get_wppb_option( 'page_template_1' ); ?></textarea>
					</p>
	
					<h3><?php _e( 'Page template 2', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper medium">
						<textarea name="<?php echo WPPB_TEMPLATES; ?><?php echo WPPB_TEMPLATES; ?>[page_template_2]" value=""><?php echo get_wppb_option( 'page_template_2' ); ?></textarea>
					</p>
				</div>
			</div>

			<div id="blog-options">
				<div class="tab-inner">
					<h3><?php _e( 'Single post template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo WPPB_TEMPLATES; ?>[single]" value=""><?php echo get_wppb_option( 'single' ); ?></textarea>
					</p>
					<h3><?php _e( 'Blog page template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo WPPB_TEMPLATES; ?>[home]" value=""><?php echo get_wppb_option( 'home' ); ?></textarea>
					</p>
				</div>
			</div>
	
			<div id="archives-options">
				<div class="tab-inner">
					<h3><?php _e( 'Archive template', 'pixopoint_theme_editor' ); ?></h3>
					<p class="textarea-wrapper">
						<textarea name="<?php echo WPPB_TEMPLATES; ?>[archive]" value=""><?php echo get_wppb_option( 'archive' ); ?></textarea>
					</p>
				</div>
			</div>

		</div>
	<p class="submit" style="float:left;margin:25px 0 0 0;">
		<input type="submit" class="button-primary" value="<?php _e( 'Save template', 'pixopoint_theme_editor' ); ?>" />
	</p>

	<input type="hidden" name="<?php echo WPPB_TEMPLATES; ?>[version]" value="<?php echo get_wppb_option( 'version' ) + 1; ?>" />
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
	 * Sanitize post thumbnail form inputs
	 * Accepts an array, returns a sanitized array
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * return array
	 */
	private function process_thumbnails() {

		// If no post sent, then bail out now
		if ( empty( $_POST['thumbnail_name'] ) )
			return;

		// Set vars
		$thumbnails = array();
		if ( isset( $_POST['thumbnail_name'] ) )
			$name = $_POST['thumbnail_name'];
		if ( isset( $_POST['thumbnail_width'] ) )
			$width = $_POST['thumbnail_width'];
		if ( isset( $_POST['thumbnail_height'] ) )
			$height = $_POST['thumbnail_height'];
		if ( isset( $_POST['thumbnail_hardcrop'] ) )
			$hardcrop = $_POST['thumbnail_hardcrop'];

		// Iterate through every name
		foreach( $name as $key => $value ) {

			// If name is blank, then continue (thumbnails with no name are useless, hence we ignore them)
			if ( '' == $name[$key] )
				continue;

			// Sanitize name
			if ( isset( $name[$key] ) )     $name[$key]     = sanitize_title( $name[$key] );

			 // Sanitize width
			if ( isset( $width[$key] ) && is_numeric( $width[$key] ) ) $width[$key]    = (int) abs( $width[$key] );
			else $width[$key] = 50;

			// Sanitize height
			if ( isset( $height[$key] ) )   $height[$key]   = (int) abs( $height[$key] );
			else $width[$key] = 50;

			// Sanitize hard cropping
			if ( isset( $hardcrop[$key] ) ) $hardcrop[$key] = (bool) $hardcrop[$key];
			else $hardcrop[$key]   = false;

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
	 * Sanitize widget form inputs
	 * Accepts an array, returns a sanitized array
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * return array
	 */
	private function process_widgets() {

		// If no post sent, then bail out now
		if ( empty( $_POST['name_widget'] ) )
			return;

		// Set vars
		$widgets = array();
		if ( isset( $_POST['name_widget'] ) )
			$name_widget = $_POST['name_widget'];
		if ( isset( $_POST['description_widget'] ) )
			$description_widget = $_POST['description_widget'];
		if ( isset( $_POST['before_widget'] ) )
			$before_widget = $_POST['before_widget'];
		if ( isset( $_POST['after_widget'] ) )
			$after_widget = $_POST['after_widget'];
		if ( isset( $_POST['before_title'] ) )
			$before_title = $_POST['before_title'];
		if ( isset( $_POST['after_title'] ) )
			$after_title = $_POST['after_title'];

		// Iterate through every name
		foreach( $name_widget as $key => $value ) {

			// If name is blank, then continue (thumbnails with no name are useless, hence we ignore them)
			if ( '' == $name_widget[$key] )
				continue;

			// Sanitize name
			if ( isset( $name_widget[$key] ) )   $name_widget[$key]   = sanitize_title( $name_widget[$key] );

			// Sanitize HTML
			if ( isset( $description_widget[$key] ) ) $description_widget[$key] = wp_kses( $description_widget[$key], $this->allowed_html, '' );
			if ( isset( $before_widget[$key] ) )      $before_widget[$key]      = wp_kses( $before_widget[$key], $this->allowed_html, '' );
			if ( isset( $after_widget[$key] ) )       $after_widget[$key]       = wp_kses( $after_widget[$key], $this->allowed_html, '' );
			if ( isset( $before_title[$key] ) )       $before_title[$key]       = wp_kses( $before_title[$key], $this->allowed_html, '' );
			if ( isset( $after_title[$key] ) )        $after_title[$key]        = wp_kses( $after_title[$key], $this->allowed_html, '' );

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
	 * Sanitize menu inputs
	 * Accepts an array, returns a sanitized array
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * return array
	 */
	private function process_menus() {

		// If no post sent, then bail out now
		if ( empty( $_POST['name_menu'] ) )
			return;

		// Set vars
		$menus = array();
		if ( isset( $_POST['name_menu'] ) )
			$name_menu = $_POST['name_menu'];

		// Iterate through every name
		foreach( $name_menu as $key => $value ) {

			// If name is blank, then continue (thumbnails with no name are useless, hence we ignore them)
			if ( '' == $name_menu[$key] )
				continue;

			// Sanitize name
			if ( isset( $name_menu[$key] ) )
				$name_menu[$key] = sanitize_title( $name_menu[$key] );

			// Set the array
			$menus[$key] = array(
				'name_menu'   => $name_menu[$key],
			);
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
	 * return array
	 */
	private function process_templates() {

		// If no post sent, then bail out now
		if ( empty( $_POST['wppb_templates'] ) )
			return;

		// Grab arrays of $_POST
		$templates = $_POST['wppb_templates'];

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
	 * echo string
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
	 * author Ryan Hellyer <ryan@pixopoint.com>
	 * return string
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
