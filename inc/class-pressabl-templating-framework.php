<?php
/*

 * PixoPoint Templating Framework
 * Version: 0.2
 * A templating framework for use with WordPress
 * 
 * Copyright (c) 2009 PixoPoint Web Development
 * http://pixopoint.com/

 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as
 * published by the Free Software Foundation.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package WordPress
 * @subpackage PixoPoint Template Framework
 *
 * PixoPoint Templating Framework
 */


/**
 * Primary class used to load the templating framework
 * Adds shortcodes for use within templates
 * 
 * @copyright Copyright (c), PixoPoint
 * @license http://www.gnu.org/licenses/gpl.html GPL
 * @author Ryan Hellyer <ryan@pixopoint.com>
 * @since 1.0
 */
class Pressabl_Templating_Framework {

	/**
	 * Class constructor
	 * Adds all the methods to appropriate hooks or shortcodes
	 * 
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com
	 * return void
	 */
	public function __construct() {
		add_shortcode( 'the_id', array( $this, 'the_id_shortcode' ) );
		add_shortcode( 'next_post_link', array( $this, 'next_post_link_shortcode' ) );
		add_shortcode( 'previous_post_link', array( $this, 'previous_post_link_shortcode' ) );
		add_shortcode( 'numeric_pagination', array( $this, 'numeric_pagination_shortcode' ) );
		add_shortcode( 'counter', array( $this, 'counter_shortcode' ) );
		add_shortcode( 'home_url', array( $this, 'home_url_shortcode' ) );
		add_shortcode( 'the_search_query', array( $this, 'the_search_query_shortcode' ) );
		add_shortcode( 'single_tag_title', array( $this, 'single_tag_title_shortcode' ) );
		add_shortcode( 'single_month_title', array( $this, 'single_month_title_shortcode' ) );
		add_shortcode( 'single_cat_title', array( $this, 'single_cat_title_shortcode' ) );
		add_shortcode( 'edit_comment_link', array( $this, 'edit_comment_link_shortcode' ) );
		add_shortcode( 'edit_post_link', array( $this, 'edit_post_link_shortcode' ) );
		add_shortcode( 'edit_tag_link', array( $this, 'edit_tag_link_shortcode' ) ); 
		add_shortcode( 'get_shortlink', array( $this, 'get_shortlink_shortcode' ) );
		add_shortcode( 'the_date', array( $this, 'the_date_shortcode' ) ); 
		add_shortcode( 'get_calendar', array( $this, 'get_calendar_shortcode' ) ); 
		add_shortcode( 'wp_dropdown_users', array( $this, 'wp_dropdown_users_shortcode' ) );
		add_shortcode( 'breadcrumbs', array( $this, 'breadcrumbs_shortcode' ) ); 
		add_shortcode( 'the_author_posts', array( $this, 'the_author_posts_shortcode' ) );
		add_shortcode( 'the_author_meta', array( $this, 'the_author_meta_shortcode' ) );
		add_shortcode( 'the_author', array( $this, 'the_author_shortcode' ) );
		add_shortcode( 'tag_description', array( $this, 'tag_description_shortcode' ) );
		add_shortcode( 'tag_cloud', array( $this, 'tag_cloud_shortcode' ) );
		add_shortcode( 'the_shortlink', array( $this, 'the_shortlink_shortcode' ) );
		add_shortcode( 'single_post_title', array( $this, 'single_post_title_shortcode' ) );
		add_shortcode( 'logout_url', array( $this, 'logout_url_shortcode' ) );
		add_shortcode( 'lostpassword_url', array( $this, 'lostpassword_url_shortcode' ) );
		add_shortcode( 'login_url', array( $this, 'login_url_shortcode' ) );
		add_shortcode( 'login_form', array( $this, 'login_form_shortcode' ) );
		add_shortcode( 'list_pages', array( $this, 'list_pages_shortcode' ) );
		add_shortcode( 'list_categories', array( $this, 'list_categories_shortcode' ) );
		add_shortcode( 'list_bookmarks', array( $this, 'list_bookmarks_shortcode' ) );
		add_shortcode( 'list_authors', array( $this, 'list_authors_shortcode' ) );
		add_shortcode( 'dropdown_users', array( $this, 'dropdown_users_shortcode' ) );
		add_shortcode( 'dropdown_pages', array( $this, 'dropdown_pages_shortcode' ) );
		add_shortcode( 'dropdown_categories', array( $this, 'dropdown_categories_shortcode' ) );
		add_shortcode( 'copyright', array( $this, 'copyright_shortcode' ) );
		add_shortcode( 'get_footer', array( $this, 'get_footer_shortcode' ) );
		add_shortcode( 'get_header', array( $this, 'get_header_shortcode' ) );
		add_shortcode( 'if', array( $this, 'if_shortcode' ) );
		add_shortcode( 'loop', array( $this, 'loop_shortcode' ) );
		add_shortcode( 'admin_note', array( $this, 'note_shortcode' ) );
		add_shortcode( 'post_thumbnail', array( $this, 'post_thumbnail_shortcode' ) );
		add_shortcode( 'siteinfo', array( $this, 'siteinfo_shortcode' ) );
		add_shortcode( 'widget', array( $this, 'widget_shortcode' ) );
		add_shortcode( 'nav_menu', array( $this, 'nav_menu_shortcode' ) );
		add_shortcode( 'the_time', array( $this, 'the_time_shortcode' ) );
		add_shortcode( 'previous_posts_link', array( $this, 'previous_posts_link_shortcode' ) );
		add_shortcode( 'get_template_directory_uri', array( $this, 'get_template_directory_uri_shortcode' ) );
		add_shortcode( 'next_posts_link', array( $this, 'next_posts_link_shortcode' ) );
		add_shortcode( 'list_comments', array( $this, 'list_comments_shortcode' ) );
		add_shortcode( 'comments_template', array( $this, 'comments_template_shortcode' ) );
		add_shortcode( 'get_archives', array( $this, 'get_archives_shortcode' ) );
		add_shortcode( 'category_description', array( $this, 'category_description_shortcode' ) );
		add_shortcode( 'the_category', array( $this, 'the_category_shortcode' ) );
		add_shortcode( 'the_tags', array( $this, 'the_tags_shortcode' ) );
		add_shortcode( 'get_avatar', array( $this, 'get_avatar_shortcode' ) );
		add_shortcode( 'post_class', array( $this, 'post_class_shortcode' ) );
		add_shortcode( 'loginout', array( $this, 'loginout_shortcode' ) );
		add_shortcode( 'comment_navigation', array( $this, 'comment_navigation_shortcode' ) );
		add_shortcode( 'comment_form', array( $this, 'comment_form_shortcode' ) );
		add_shortcode( 'comments_number', array( $this, 'comments_number_shortcode' ) );
		add_shortcode( 'return', array( $this, 'return_shortcode' ) );
		add_shortcode( 'the_author_posts_link', array( $this, 'the_author_posts_link_shortcode' ) );
		add_shortcode( 'custom_field', array( $this, 'custom_field_shortcode' ) );
		add_shortcode( 'page_menu', array( $this, 'page_menu_shortcode' ) );
		add_shortcode( 'the_permalink', array( $this, 'the_permalink_shortcode' ) );
		add_shortcode( 'the_title', array( $this, 'the_title_shortcode' ) );
		add_shortcode( 'the_content', array( $this, 'the_content_shortcode' ) );
		add_shortcode( 'the_excerpt', array( $this, 'the_excerpt_shortcode' ) );
		add_shortcode( 'the_content_limit', array( $this, 'the_content_limit_shortcode' ) );
		add_shortcode( 'link_pages', array( $this, 'link_pages_shortcode' ) );
		add_shortcode( 'onfocus', array( $this, 'onfocus_shortcode' ) );
	}

	/**
	 * [the_id] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com
	 * return string
	 */
	public function the_id_shortcode( $atts ) {
		return get_the_ID();
	}

	/**
	 * [custom_field] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com
	 * return string
	 */
	public function custom_field_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'name'     => 'custom field text goes here', 
				),
				$atts
			)
		);
	
		return get_post_meta(
			get_the_id(),
			sanitize_title_with_dashes( $name ),
			true
		);
	}
	
	/**
	 * [page_menu] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com
	 * return string
	 */
	public function page_menu_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'include'     => '', 
					'exclude'     => '', 
					'show_home'   => 'true', 
					'link_before' => '', 
					'link_after'  => '', 
				),
				$atts
			)
		);
	
		// Sanitise as comma delimited list of numbers
		$include = $this->sanitize_comma_numeric( $include );
		$exclude = $this->sanitize_comma_numeric( $exclude );
	
		// True or false settings
		if ( 'false' == $show_home )
			$show_home = 0;
		else
			$show_home = 1;
	
		// Sanitise HTML
		$link_before = sanitize_title( $link_before, '' );
		$link_after = sanitize_title( $link_after, '' );
	
		return wp_page_menu( 'echo=0&include=' . $include . '&exclude=' . $exclude . '&show_home=' . $show_home . '&link_before=' . $link_before . '&link_after=' . $link_after );
	}
	
	/**
	 * [the_permalink] shortcode
	 * @since 0.1
	 */
	public function the_permalink_shortcode() {
		return apply_filters( 'the_permalink', get_permalink() );
	}
	
	/**
	 * [the_title] shortcode
	 * @since 0.1
	 */
	public function the_title_shortcode() {
		return the_title(
			'', // before
			'', // after
			false // echo
		);
	}
	
	/**
	 * [the_content] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * @since 0.1
	 */
	public function the_content_shortcode() {
		ob_start();
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wppb_lang' ) );
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	/**
	 * [the_excerpt] shortcode
	 * @since 0.1
	 */
	public function the_excerpt_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'words'     => '',
					'characters'=> '',
					'readmore'  => '[...]',
					'link'      => 'no'
				),
				$atts
			)
		);
	
		// Strip nasties from readmore (probably not necessary since wp_kses() already parses content before entering DB)
		$readmore = esc_html( $readmore );
	
		// Link read more
		if ( 'yes' == $link )
			$readmore = '<a href="' . get_permalink() . '">' . $readmore . '</a>';
	
	
		// Excerpt with word limit
		if ( is_numeric( $words ) ) {
			if ( !function_exists( 'pixopoint_the_excerpt_words' ) ) {
				function pixopoint_the_excerpt_words( $words ) {
					return intval( $words );
				}
			}
			add_filter( 'excerpt_length', 'pixopoint_the_excerpt_words' );
			return apply_filters( 'the_excerpt', get_the_excerpt() );
		}
	
		// Excerpt with character limit
		elseif ( is_numeric( $characters ) ) {
			$excerpt = substr( get_the_excerpt(), 0, intval( $characters ) );
			if ( strlen( $excerpt ) < strlen( get_the_excerpt() ) ) {
				$excerpt = $excerpt . '[...]';
				return '<p>' . $excerpt . '</p>';
			}
		}
	
		// Or revert to regular excerpt
		else {
			$excerpt = '<p>' . get_the_excerpt() . '</p>'; 
			$excerpt = str_replace( '[...]', $readmore, $excerpt );
			return $excerpt;
		}
	
	}
	
	/**
	 * [the_content_limit] shortcode
	 * @since 0.1
	 */
	public function the_content_limit_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'number_characters'     => '',
					'strip_tags'            => 'yes'
				),
				$atts
			)
		);
	
		// Stick the content into a string
		$excerpt = get_the_content();
	
		// Strip tags
		if ( 'yes' == $strip_tags )
			$excerpt = strip_tags( $excerpt );
	
		// Limit number of characters (if integer value)
		if ( is_numeric( $number_characters ) )
			$excerpt = substr( $excerpt, 0, $number_characters );
	
		// Finally, spit out the excerpt
		return $excerpt;
	}
	
	/**
	 * [link_pages] shortcode
	 * @since 1.0
	 */
	public function link_pages_shortcode() {
		$link_pages = wp_link_pages(
			array(
				'before' => '<p class="page-link"><span>' . __( 'Pages:', 'wppb_lang' ) . '</span>',
				'after'  => '</p>',
				'echo'   => 0
			)
		);
		return $link_pages;
	}
	
	/**
	 * [the_author_posts_link] shortcode
	 * @since 0.1
	 */
	public function the_author_posts_link_shortcode() {
		ob_start();
		the_author_posts_link();
		$author = ob_get_contents();
		ob_end_clean();
		return $author;
	}
	
	/**
	 * [return] shortcode
	 * @since 0.1
	 */
	public function return_shortcode() {
		return;
	}
	
	/**
	 * [comments_number] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * @since 0.1
	 */
	public function comments_number_shortcode() {
		ob_start();
		comments_number(
			sprintf( __( 'No Responses to %s', 'pixopoint_theme_editor' ), '<em>' . get_the_title() . '</em>' ),
			sprintf( __( 'One Response to %s', 'pixopoint_theme_editor' ), '<em>' . get_the_title() . '</em>' ),
			sprintf( __( '%% Responses to %s', 'pixopoint_theme_editor' ), '<em>' . get_the_title() . '</em>' )
		);
		$comments = ob_get_contents();
		ob_end_clean();
		return $comments;
	}

	/**
	 * [comment_form] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_form() which can only be echo'd
	 * @since 0.1
	 */
	public function comment_form_shortcode() {
		ob_start();
		comment_form();
		$comments = ob_get_contents();
		ob_end_clean();
		return $comments;
	}
	
	/**
	 * [onfocus] shortcode
	 * @since 1.0
	 */
	public function onfocus_shortcode( $atts, $content ) {
		$content = $this->sanitize_names( $content ); // Blitz everything but alpha numerics, _'s or -'s and spaces
	
		return 'onFocus="this.value=\'' . $content . '\'"';
	}
	
	/**
	 * [comment_navigation] shortcode
	 * @since 0.1
	 */
	public function comment_navigation_shortcode() {
	
		if ( get_comment_pages_count() > 1 ) { // are there comments to navigate through
		$comment_navigation = "<div class='navigation'>
			<div class='nav-previous'>
				" . get_previous_comments_link( __( '&larr; Older Comments', 'wppb_lang' ) ) . "
			</div>
			<div class='nav-next'>
				" . get_next_comments_link( __( 'Newer Comments &rarr;', 'wppb_lang' ) ) . "
			</div>
		</div>";
		}
		return $comment_navigation;
	}
	
	/**
	 * [loginout] shortcode
	 * @since 0.1
	 */
	public function loginout_shortcode() {
		return wp_loginout( '', false );
	/*
		return wp_loginout(
			array(
				'name' => '',
				'echo' => false,
			)
		);
	*/
	}
	
	/**
	 * [post_class] shortcode
	 * @since 0.1
	 */
	public function post_class_shortcode( $atts ) {
		$post_class = '';
		foreach ( get_post_class() as $class ) {
			$post_class .= $class . ' ';
		}
		return $post_class;
	}
	
	/**
	 * [get_avatar] shortcode
	 * @since 0.1
	 */
	public function get_avatar_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'size' => '80' 
				),
				$atts
			)
		);
	
		// Strip out unnecessary stuff
		if ( !is_numeric( $size ) )
			$size = 80;
		$size = (int) $size;
	
		return get_avatar( get_the_author_meta( 'user_email' ), $size );
	}
	
	/**
	 * [the_tags] shortcode
	 * @since 0.1
	 */
	public function the_tags_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'separator' => ', ' 
				),
				$atts
			)
		);
	
		$separator = esc_html( $separator );
	
		return get_the_tag_list( __( 'Tags: ', 'wppb_lang' ), $separator, '' );
	}
	
	/**
	 * [the_category] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * @since 0.1
	 */
	public function the_category_shortcode( $atts ) {
	
		ob_start();
	
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'separator' => ', ' 
				),
				$atts
			)
		);
	
		$separator = esc_html( $separator );
	
		the_category( $separator );
	
		$the_category = ob_get_contents();
		ob_end_clean();
		return $the_category;
	}
	
	/**
	 * [category_description] shortcode
	 * @since 0.1
	 */
	public function category_description_shortcode( $atts, $content = null ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'slug' => '' 
				),
				$atts
			)
		);
	
		// Sanitise slugs
		$slug = sanitize_title_with_dashes( $slug );
	
		return category_description( get_category_by_slug ( $slug ) -> term_id );
	}
	
	/**
	 * [get_archives] shortcode
	 *
	 * @link http://codex.wordpress.org/Template_Tags/wp_get_archives
	 * @since 0.1
	 */
	public function get_archives_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'type'            => 'monthly', 
					'limit'           => '', 
					'show_post_count' => 0, 
				),
				$atts
			)
		);
	
		// Check for numerical values
		if ( !is_numeric( $limit ) )
			$limit = '';
		else
			$limit = (int) $limit;
		$args = 'limit=' . $limit;
	
		// Confirm if 0 or 1
		if ( 0 == $show_post_count OR 1 == $show_post_count ) {
			$show_post_count = '0';
			$args = $args . '&show_post_count=' . $show_post_count;
		}
	
		/* Check all possibilities and set to "monthly" if set incorrectly */
		switch ( $type ) {
			case    'yearly':           break;
			case    'monthly':          break;
			case    'daily':            break;
			case    'weekly':           break;
			case    'postbypost ':      break;
			case    'alpha':            break;
			default: $type = 'monthly'; break;
		}
		$args = $args . '&type=' . $type;
	
		// Return value instead of echo'ing
		$args = $args . '&echo=0';
	
		return wp_get_archives( $args );
	}
	
	/**
	 * [comments_template] shortcodes
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * @since 0.1
	 */
	public function comments_template_shortcode() {
		ob_start();
		comments_template();
		$comments_template = ob_get_contents();
		ob_end_clean();
		return $comments_template;
	}
	
	/**
	 * [list_comments] shortcodes
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * @since 0.1
	 */
	public function list_comments_shortcode() {
		ob_start();
		wp_list_comments();
		$wp_list_comments = ob_get_contents();
		ob_end_clean();
		return $wp_list_comments;
	}
	
	/**
	 * [next_posts_link] shortcode
	 * @since 0.1
	 */
	public function next_posts_link_shortcode() {
		return get_next_posts_link( null, 0 );
	}
	
	/**
	 * [get_template_directory_uri] shortcode
	 * @since 0.1
	 */
	public function get_template_directory_uri_shortcode() {
		return get_template_directory_uri();
	}
	
	/**
	 * [previous_posts_link] shortcode
	 * @since 0.1
	 */
	public function previous_posts_link_shortcode() {
		return get_previous_posts_link( null, 0 );
	}
	
	/**
	 * [the_time] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * @since 0.1
	 */
	public function the_time_shortcode( $atts, $content = null ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'format' => '' 
				),
				$atts
			)
		);
	
		// Strip out unnecessary stuff
		$format = $this->sanitize_names( $format ); // Blitz everything but alpha numerics, _'s or -'s and spaces
	
		ob_start();
		the_time( $format );
		$the_time = ob_get_contents();
		ob_end_clean();
		return $the_time;
	}
	
	/**
	 * [nav_menu] shortcodes
	 * @since 0.1
	 */
	public function nav_menu_shortcode( $atts, $content = null ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'theme_location' => '' 
				),
				$atts
			)
		);
	
		if ( 'primary-menu' != $theme_location && 'secondary-menu' != $theme_location )
			$return;
	
		return wp_nav_menu(
			array(
				'theme_location' => $theme_location,
				'container'      => 'div',
				'menu_class'     => 'menu',
				'echo'           => false,
			)
		);
	}
	
	/**
	 * [widget] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in dynamic_sidebar() which can only be echo'd
	 * @since 0.1
	 */
	public function widget_shortcode( $atts, $content = null ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'number' => '' 
				),
				$atts
			)
		);
	
		if ( !is_numeric( $number ) )
			return;
		$number = (int) $number;
	
		ob_start();
		if ( !dynamic_sidebar( 'widgetarea' . $number ) )
			return do_shortcode( $content );
		$widgets = ob_get_contents();
		ob_end_clean();
		return $widgets;
	}
	
	/**
	 * [siteinfo] shortcode
	 * @since 0.1
	 */
	public function siteinfo_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'type' => ''
				),
				$atts
			)
		);
	
		// Check all possibilities and set to "name" if set incorrectly
		switch ( $type ){
			case    'name':              break;
			case    'description':       break;
			case    'admin_email':       break;
			case    'url':               break;
			case    'wpurl':             break;
			case    'atom_url':          break;
			case    'rss2_url':          break;
			case    'rss_url':           break;
			case    'pingback_url':      break;
			case    'rdf_url':           break;
			case    'comments_atom_url': break;
			case    'comments_rss2_url': break;
			default: $type = 'name';     break;
		}
	
		// Return required PHP code 
		return get_bloginfo( $type, 'display' );
	}

	/**
	 * [post_thumbnail] shortcode
	 * @since 0.1
	 */
	public function post_thumbnail_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'name'  => ''
				),
				$atts
			)
		);
	
		// Error message if thumbnails not turned on
	//	if ( !function_exists( 'has_post_thumbnail' ) )
	//		echo 'Post thumbnails not activated';
	
		// Sanitise name
		$name = esc_html( $name );
	
		// Outputting the thumbnail
		if ( function_exists( 'has_post_thumbnail' ) ) { // need function check in case they haven't set a thumbnail up at all
			if ( has_post_thumbnail() )
				return get_the_post_thumbnail( null, $name, '' );
		}
	}
	
	/**
	 * [admin_note] shortcode
	 * @since 0.1
	 */
	public function note_shortcode( $atts, $content = null ) {
		 if ( current_user_can( 'publish_posts' ) )
			return '<div class="note">' . $content . '</div>';
	}
	
	/**
	 * [loop] shortcode
	 * todo: Output buffering may not be necessary here. May be able to return string directly
	 * @since 0.1
	 */
	public function loop_shortcode( $atts, $content = null ) {
		ob_start();
	
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'category_name'  => '',
					'tag'            => '',
					'author_name'    => '',
					'name'           => '',
					'pagename'       => '',
					'post_type'      => '',
					'posts_per_page' => '',
					'offset'         => '',
					'orderby'        => '',
					'order'          => ''
				),
				$atts
			)
		);
	
		// Seting variables
		$query = '';
	
		// Santise/validate numeric data
		if ( is_numeric( $posts_per_page ) )
			$query .= 'posts_per_page=' . (int) $posts_per_page . '&';
	
		if ( is_numeric( $offset ) )
			$query .= 'offset=' . (int) $offset . '&';
	
		// Sanitise slugs
		if ( '' != $category_name )
			$query .= 'category_name=' . sanitize_title_with_dashes( $category_name ) . '&';
		if ( '' != $tag )
			$query = $query . 'tag=' . sanitize_title_with_dashes( $tag ) . '&';
		if ( '' != $author_name )
			$query .= 'author_name=' . sanitize_title_with_dashes( $author_name ) . '&';
		if ( '' != $name )
			$query .= 'name=' . sanitize_title_with_dashes( $name ) . '&';
		if ( '' != $pagename )
			$query .= 'pagename=' . sanitize_title_with_dashes( $pagename ) . '&';
	
		// Sanitise post type
		if ( 'page' == $post_type OR 'post' == $post_type OR 'slider_gallery' == $post_type )
			$query .= 'post_type=' . $post_type . '&';
	
		// Sanitise order
		if ( 'ASC' == $order AND 'DESC' == $order )
			$query .= 'order=' . $order . '&';
	
		// Sanitise post type
		switch ( $orderby ) {
			case 'author':           $query .= 'orderby=' . $orderby . '&'; break;
			case 'date':             $query .= 'orderby=' . $orderby . '&'; break;
			case 'title':            $query .= 'orderby=' . $orderby . '&'; break;
			case 'modified':         $query .= 'orderby=' . $orderby . '&'; break;
			case 'menu_order':       $query .= 'orderby=' . $orderby . '&'; break;
			case 'parent':           $query .= 'orderby=' . $orderby . '&'; break;
			case 'ID':               $query .= 'orderby=' . $orderby . '&'; break;
			case 'rand':             $query .= 'orderby=' . $orderby . '&'; break;
			case 'none':             $query .= 'orderby=' . $orderby . '&'; break;
			case 'comment_count':    $query .= 'orderby=' . $orderby . '&'; break;
			default: break;
		}
	
		// Remove last &
		$query = substr_replace( $query , '', -1 );
	
		// Add PHP string, or blitz query entirely if not needed
		if ( '' != $query )
			query_posts( $query );
	
		// Create PHP
		if ( is_404() ) {
			
			$pages = get_pages();
			foreach ( $pages as $page ) {
			$apage = $page->post_name;
			$page_404 = '';
			if ( $apage == '404-error' )
				$page_404 = 'load';
			}
			// If the 404-error page is found, then load that
			if ( 'load' == $page_404 )		
				query_posts( 'post_type=page&name=404-error' );
			// Otherwise load default 404 HTML
			else {
				echo '
				<h1>' . __( 'Not Found', 'wppb_lang' ) . '</h1>
				<p>' . __( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'wppb_lang' ) . '</p>';
				get_search_form();
			}	
		}
	
		// Display post/page
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			// Return filtered output
			echo do_shortcode( $content );
		endwhile; endif;
	
		$loop = ob_get_contents();
		ob_end_clean();
	
		return $loop;
	}
	
	/**
	 * [if] shortcode
	 * @since 0.1
	 */
	public function if_shortcode( $atts, $content = null ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'condition' => '', 
					'slug' => '', 
				),
				$atts
			)
		);
	
		// Sanitise slugs
		$slug = sanitize_title( $slug );
	
		// Check all possibilities and set to "name" if set incorrectly
		switch ( $type ){
			case 'is_page':                $slug = " '" . $slug . "' "; break;
			case '!is_page':               $slug = " '" . $slug . "' "; break;
			case 'is_category':            $slug = " '" . $slug . "' "; break;
			case '!is_category':           $slug = " '" . $slug . "' "; break;
			case 'is_single':              $slug = " '" . $slug . "' "; break;
			case '!is_single':             $slug = " '" . $slug . "' "; break;
			case 'is_tag':                 $slug = " '" . $slug . "' "; break;
			case '!is_tag':                $slug = " '" . $slug . "' "; break;
			case 'is_author':              $slug = " '" . $slug . "' "; break;
			case '!is_author':             $slug = " '" . $slug . "' "; break;
			case 'in_category':            $slug = " '" . $slug . "' "; break;
			case '!in_category':           $slug = " '" . $slug . "' "; break;
			case 'is_sticky':              break;
			case '!is_sticky':             break;
			case 'is_date':                break;
			case '!is_date':               break;
			case 'is_year':                break;
			case '!is_year':               break;
			case 'is_month':               break;
			case '!is_month':              break;
			case 'is_day':                 break;
			case '!is_day':                break;
			case 'is_time':                break;
			case '!is_time':               break;
			case 'is_archive':             break;
			case '!is_archive':            break;
			case 'is_search':              break;
			case '!is_search':             break;
			case 'is_404':                 break;
			case '!is_404':                break;
			case 'is_user_logged_in':      break;
			case '!is_user_logged_in':     break;
			case 'is_paged':               break;
			case '!is_paged':              break;
			case 'is_attachment':          break;
			case '!is_attachment':         break;
			case 'is_singular':            break;
			case '!is_singular':           break;
			case 'comments_open':          break;
			case '!comments_open':         break;
			case 'has_tag':                break;
			case '!has_tag':               break;
			case 'is_page_template':       break;
			case '!is_page_template':      break;
			case 'is_preview':             break;
			case '!is_preview':            break;
			case 'pings_open':             break;
			case '!pings_open':            break;
			case 'is_trackback':           break;
			case '!is_trackback':          break;
			case 'post_password_required': break;
			case '!post_password_required':break;
			case 'have_comments':          break;
			case '!have_comments':         break;
			default: $condition = 'is_page';    break;
		}
	
		// If condtion is set, then display content
		if ( $condition( $slug ) )
			return do_shortcode( $content );
	}
	
	/**
	 * [get_header] shortcode
	 * @since 0.1
	 * Specific to PixoPoint Template Editor
	 */
	public function get_header_shortcode() {
		get_header();
	}
	
	/**
	 * [get_footer] shortcode
	 * @since 0.1
	 * Specific to PixoPoint Template Editor
	 */
	public function get_footer_shortcode() {
		get_footer();
	}
	
	/**
	 * [copyright] shortcode
	 * Attempts to load specified copyright, otherwise loads default one
	 * @since 0.1
	 */
	public function copyright_shortcode() {
		return PIXOPOINT_SETTINGS_COPYRIGHT; 
	}
	
	/**
	 * [dropdown_categories] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function dropdown_categories_shortcode() {
		$cats = '<form action="' . home_url() . '/" method="get">';
	
		$select = wp_dropdown_categories( "show_option_none=Select category&show_count=1&orderby=name&echo=0" );
		$select = preg_replace( "#<select([^>]*)>#", "<select$1 onchange=\"return this.form.submit()\">", $select );
	
		return $cats . $select . '<noscript><input type="submit" value="View" /></noscript></form>';
	}
	
	/**
	 * [dropdown_pages] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function dropdown_pages_shortcode() {
		return "<form action='" . home_url() . "' method='get'>" . wp_dropdown_pages( 'echo=0' ) . "<input type='submit' name='submit' value='view' /></form>";
	}
	
	/**
	 * [dropdown_users] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function dropdown_users_shortcode() {
		return '<form action="' . home_url() . '" method="get">' . wp_dropdown_users(
			array(
				'name' => 'author',
				'echo' => false,
			)
		) . '<input type="submit" name="submit" value="view" /></form>';
	}
	
	/**
	 * [list_authors] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function list_authors_shortcode() {
		return wp_list_authors( 'show_fullname=1&optioncount=1&echo=0' );
	}
	
	/**
	 * [list_bookmarks] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function list_bookmarks_shortcode() {
		return wp_list_bookmarks( 'title_li&categorize=0&echo=0' );
	}
	
	/**
	 * [list_categories] shortcode
	 *
	 * @link http://codex.wordpress.org/Template_Tags/wp_list_categories
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function list_categories_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'include '        => '',
					'exclude'         => '',
					'orderby'         => 'name',
					'order'           => 'ASC',
					'hide_empty'      => 'yes',
					'child_of'         => '',
					'hierarchical'    => '1',
					'number'          => 20,
					'depth'           => 0,
					
				),
				$atts
			)
		);
	
		// Comma delimited numerical lists
		$include = $this->sanitize_comma_numeric( $include );
		$exclude = $this->sanitize_comma_numeric( $exclude );
	
		// Check all possibilities and set to 'name' if incorrect
		switch ( $orderby ){
			case 'ID': break;
			case 'name': break;
			case 'slug': break;
			case 'count': break;
			default: $orderby = 'name'; break;
		}
	
		// Order
		if ( 'DESC' != $order AND 'ASC' != $order )
			$order = 'ASC';
	
		// Yay or nay options
		switch ( $hide_empty ){
			case 'yes': $hide_empty = 1; break;
			case 'no': $hide_empty = 0; break;
			case '': $hide_empty = 1; break;
			default: $hide_empty = 1; break;
		}
		switch ( $hierarchical ){
			case 'yes': $hierarchical = 1; break;
			case 'no': $hierarchical = 0; break;
			case '': $hierarchical = 1; break;
			default: $hierarchical = 1; break;
		}
	
		// Integers
		if ( !is_numeric( $number ) )
			$number = 20;
		if ( !is_numeric( $depth ) )
			$number = 0;
		$number = (int) $number;
		if ( !is_numeric( $child_of ) )
			$child_of = '';
		$child_of = (int) $child_of;
	
		return wp_list_categories( 'echo=0&title_li=&include=' . $include . '&exclude=' . $exclude . '&orderby=' . $orderby . '&hierarchical' . $hierarchical . '&number=' . $number . '&depth=' . $depth . '&child_of=' . $child_of );
	}
	
	/**
	 * [list_pages] shortcode
	 *
	 * @link http://codex.wordpress.org/Template_Tags/wp_list_categories
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function list_pages_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'include '       => '',
					'exclude'        => '',
					'sort_column'    => 'post_title',
					'sort_order'     => 'ASC',
					'number'         => 20,
					'depth'          => 0,
					'child_of'       => '',
				),
				$atts
			)
		);
	
		// Comma delimited numerical lists
		$include = $this->sanitize_comma_numeric( $include );
		$exclude = $this->sanitize_comma_numeric( $exclude );
	
		// Check all possibilities and set to 'name' if incorrect
		switch ( $sort_column ){
			case     'post_title':            break;
			case     'menu_order':            break;
			case     'post_date':             break;
			case     'ID':                    break;
			case     'post_author':           break;
			case     'post_name':             break;
			default: $orderby = 'post_title'; break;
		}
	
		// Sort order
		if ( 'DESC' != $sort_order && 'ASC' != $sort_order )
			$order = 'ASC';
	
		// Yay or nay options
		switch ( $hide_empty ){
			case     'yes': $hide_empty = 1; break;
			case     'no':  $hide_empty = 0; break;
			case     '':    $hide_empty = 1; break;
			default:        $hide_empty = 1; break;
		}
	
		// Integers
		if ( !is_numeric( $number ) )
			$number = 20;
		if ( !is_numeric( $depth ) )
			$number = 0;
		$number = (int) $number;
		if ( !is_numeric( $child_of ) )
			$child_of = '';
		$child_of = (int) $child_of;
	
		return wp_list_pages( 'echo=0&title_li=&include=' . $include . '&exclude=' . $exclude . '&sort_column=' . $sort_column . '&number=' . $number . '&depth=' . $depth . '&child_of=' . $child_of );
	}
	
	/**
	 * [login_form] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function login_form_shortcode() {
		wp_login_form( 'echo=0' );
	}
	
	/**
	 * [login_url] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function login_url_shortcode() {
		return wp_login_url();
	}
	
	/**
	 * [lostpassword_url] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function lostpassword_url_shortcode() {
		ob_start();
		wp_lostpassword_url();
		$lostpassword_url = ob_get_contents();
		ob_end_clean();
		return $lostpassword_url;
	}
	
	/**
	 * [logout_url] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function logout_url_shortcode() {
		return wp_logout_url();
	}
	
	/**
	 * [single_post_title] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function single_post_title_shortcode() {
		ob_start();
		single_post_title();
		$title = ob_get_contents();
		ob_end_clean();
		return $title;
	}
	
	/**
	 * [the_shortlink] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function the_shortlink_shortcode() {
		return wp_get_shortlink();
	}
	
	/**
	 * [tag_cloud] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function tag_cloud_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'smallest' => 8,
					'largest'  => 22,
					'number'   => 45,
					'orderby'  => 'name',
					'order'    => 'ASC'
				),
				$atts
			)
		);
	
		// Check integers
		if ( !is_numeric( $smallest ) )
			$smallest = 8;
		$smallest = (int) $smallest;
		if ( !is_numeric( $largest ) )
			$largest = 22;
		$largest = (int) $largest;
		if ( !is_numeric( $number ) )
			$number = 45;
		$number = (int) $number;
	
		// Check all possibilities and set to 'name' if incorrect
		switch ( $orderby ){
			case                'name':  break;
			case                'count': break;
			default: $orderby = 'name';  break;
		}
		switch ( $order ) {
			case                'ASC':  break;
			case                'DESC': break;
			case                'RAND': break;
			default: $order =   'ASC';  break;
		}
	
		return wp_tag_cloud( 'echo=0&smallest=' . $smallest . '&largest=' . $largest . '&number=' . $number . '&orderby=' . $orderby . '&order=' . $order );
	}
	
	/**
	 * [tag_description] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function tag_description_shortcode() {
		return tag_description();
	}
	
	/**
	 * [the_author] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function the_author_shortcode() {
		return get_the_author();
	}
	
	/**
	 * [the_author_meta] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function the_author_meta_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'field' => 'nickname',
					'userID'  => ''
				),
				$atts
			)
		);
	
		if ( !is_int( $userID ) )
			$userID = '';
	
		// Check all possibilities and set to 'nickname' if incorrect
		switch ( $field ){
			case 'user_nicename': break;
			case 'user_url': break;
			case 'display_name': break;
			case 'nickname': break;
			case 'first_name': break;
			case 'last_name': break;
			case 'description': break;
			case 'jabber': break;
			case 'aim': break;
			case 'yim': break;
			case 'description': break;
			default: $field = 'nickname'; break;
		}
	
		return apply_filters(
			'the_author_' . $field, 
			get_the_author_meta(
				$field,
				$userID
			),
			$userID
		);
	}
	
	/**
	 * [the_author_posts] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	*/
	public function the_author_posts_shortcode() {
		return get_the_author_posts();
	}
	
	/**
	 * [breadcrumbs] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	*/
	public function breadcrumbs_shortcode( $atts ) {
	
		ob_start();	
		if ( class_exists( 'breadcrumb_navigation_xt' ) ) {
			echo 'Browse > ';
			$mybreadcrumb = new breadcrumb_navigation_xt;
			$mybreadcrumb->opt['title_blog'] = 'Home';
			$mybreadcrumb->opt['separator'] = ' / ';
			$mybreadcrumb->opt['singleblogpost_category_display'] = true;
			$mybreadcrumb->display();
		}
		$breadcrumbs = ob_get_content();
		ob_end_clean();
		return $breadcrumbs;
	}
	
	/**
	 * [wp_dropdown_users] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function wp_dropdown_users_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'show_option_all'  => '',
					'show_option_none' => '',
					'orderby'          => 'display_name',
					'order'            => 'nickname',
					'include'          => 'nickname',
					'exclude'          => 'nickname'
				),
				$atts
			)
		);
	
		// Check yes's and no's
		if ( 'yes' != $show_option_all )
			$show_option_all = 1;
		if ( 'no' != $show_option_all && '' != $show_option_all )
			$show_option_all = '';
		if ( 'yes' != $show_option_none )
			$show_option_none = 1;
		if ('no' != $show_option_none && '' != $show_option_none )
			$show_option_none = '';
	
		// Check all possibilities and set to 'display_name' if incorrect
		switch ( orderby ){
			case                'ID':            break;
			case                'user_nicename': break;
			case                'display_name':  break;
			case                '':              break;
			case                '':              break;
			case                '':              break;
			default: $orderby = 'display_name';  break;
		}
	
		// Sanitise order
		if ( 'ASC' != $order AND 'DESC' != $order )
			$order = 'ASC';
	
		// Sanitise as comma delimited list of numbers
		$include = $this->sanitize_comma_numeric( $include );
		$exclude = $this->sanitize_comma_numeric( $exclude );
	
		wp_dropdown_users(
			array(
				'show_option_all'  => $show_option_all,
				'show_option_none' => $show_option_none,
				'orderby'          => $orderby,
				'order'            => $order,
				'include'          => $include,
				'exclude'          => 'exclude',
				'echo'             => 0,
			)
		);
	}
	
	/**
	 * [get_calendar] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	*/
	public function get_calendar_shortcode() {
		return get_calendar( true, false );
	}
	
	/**
	 * [the_date] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	*/
	public function the_date_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'format'  => 'Y-m-d'
				),
				$atts
			)
		);
	
		// Strip out unnecessary stuff
		$format = preg_replace( '/[^a-z_0-9-_A-Z-_ ]/', ',' , $format ); // Blitz everything but alpha numerics, _'s or -'s
	
		return the_date( $format, '', '', false );
	}
	
	/**
	 * [get_shortlink] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	*/
	public function get_shortlink_shortcode() {
		return wp_get_shortlink();
	}
	
	/**
	 * [edit_tag_link] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	*/
	public function edit_tag_link_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'text'  => 'Edit post'
				),
				$atts
			)
		);
	
		// Sanitization of edit text
		$text = sanitize_title( $text );
	
		ob_start();
		edit_tag_link( $text );
		$edit_tag = ob_get_contents();
		ob_end_clean();
		return $edit_tag;
	}
	
	/**
	 * [edit_post_link] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function edit_post_link_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'text'  => 'Edit post'
				),
				$atts
			)
		);
	
		// Sanitization of edit text
		$text = sanitize_title( $text );
	
		ob_start();
		edit_post_link( $text );
		$edit_link = ob_get_contents();
		ob_end_clean();
		return $edit_link;
	}
	
	/**
	 * [edit_comment_link] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function edit_comment_link_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'text'  => 'Edit tag'
				),
				$atts
			)
		);
	
		// Sanitization of edit text
		$text = sanitize_title( $text );
	
		ob_start();
		edit_comment_link( $text, '', '' );
		$edit_link = ob_get_contents();
		ob_end_clean();
		return $edit_link;
	}
	
	/**
	 * [single_cat_title] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function single_cat_title_shortcode() {
		return single_cat_title();
	}
	
	/**
	 * [single_month_title] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function single_month_title_shortcode() {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'text'  => 'Edit tag'
				),
				$atts
			)
		);
	
		// Sanitization of edit text
		$text = sanitize_title( $text );
	
		return single_month_title( $text, false );
	}

	/**
	 * [single_tag_title] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function single_tag_title_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'text'  => 'Edit tag'
				),
				$atts
			)
		);
	
		// Sanitization of edit text
		$text = sanitize_title( $text );
	
		return single_tag_title( $text );
	}
	
	/**
	 * [the_search_query] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function the_search_query_shortcode() {
		return esc_attr( apply_filters( 'the_search_query', get_search_query( false ) ) );
	}
	
	/**
	 * [home_url] shortcode
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function home_url_shortcode() {
		return home_url();
	}
	
	/**
	 * [counter] shortcode
	 * 
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function counter_shortcode() {
		// Counter needs to be global to make sure the shortcode increases by 1 each time it is fired
		global $counter;
	
		// Setting $counter in case it doesn't exist yet
		if ( !isset( $counter ) )
			$counter = 0;
	
		// Increase counter by 1
		$counter++;
	
		return $counter;
	}
	
	/*
	 * [numeric_pagination] shortcode
	 * Uses output buffering to save rewriting a bunch of code to prevent it from echo'ing HTML
	 * @since 0.1
	 */
	public function numeric_pagination_shortcode( $pages = '', $range = 2 ) {
		ob_start();
	
		// Beginning of numeric pagination - code developed from the excellent Genesis theme by StudioPress (http://studiopress.com/)
	
		if( !is_singular() ) : // do nothing
	
		global $wp_query;
	
		// Stop execution if there\'s only 1 page
		if( $wp_query->max_num_pages <= 1 ) return;
	
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged') ) : 1;
		$max = intval( $wp_query->max_num_pages );
	
		//	add current page to the array
		if ( $paged >= 1 )
			$links[] = $paged;
		
		//	add the pages around the current page to the array
		if ( $paged >= 3 ) {
			$links[] = $paged - 1; $links[] = $paged - 2;
		}
		if ( ($paged + 2) <= $max ) { 
			$links[] = $paged + 2; $links[] = $paged + 1;
		}
	
		//	Previous Post Link
		if ( get_previous_posts_link() )
			printf( '<li>%s</li>' . "\n", get_previous_posts_link( __( '&laquo; Previous', 'wppb_lang') ) );
	
		//	Link to first Page, plus ellipeses, if necessary
		if ( !in_array( 1, $links ) ) {
			if ( $paged == 1 )
				$current = ' class="active"';
			else
				$current = null;
			printf(
				'<li %s><a href="%s">%s</a></li>' . "\n",
				$current,
				get_pagenum_link(1),
				'1'
			);
	
			if ( !in_array( 2, $links ) )
				echo '<li>&hellip;</li>';
		}
	
		//	Link to Current page, plus 2 pages in either direction (if necessary).
		sort( $links );
		foreach( (array)$links as $link ) {
			$current = ( $paged == $link ) ? 'class="active"' : '';
			printf(
				'<li %s><a href="%s">%s</a></li>' . "\n",
				$current,
				get_pagenum_link( $link ),
				$link
			);
		}
	
		//	Link to last Page, plus ellipses, if necessary
		if ( !in_array( $max, $links ) ) {
			if ( !in_array( $max - 1, $links ) )
				echo '<li>&hellip;</li>' . "\n";
			
			$current = ( $paged == $max ) ? 'class="active"' : '';
			printf(
				'<li %s><a href="%s">%s</a></li>' . "\n",
				$current,
				get_pagenum_link( $max ),
				$max
			);
		}
	
		//	Next Post Link
		if ( get_next_posts_link() )
			printf(
				'<li>%s</li>' . "\n",
				get_next_posts_link( __( 'Next &raquo;', 'wppb_lang' ) ) );
		endif;
	
		$pagination = ob_get_contents();
		ob_end_clean();
		return $pagination;
	}
	
	/**
	 * [previous_post_link] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * 
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function previous_post_link_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'text'  => 'Previous post link'
				),
				$atts
			)
		);
	
		// Sanitization of text
		$text = esc_html( $text );
	
		ob_start();
		previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', $text, 'coraline' ) . '</span> %title' );
		$previous_post_link = ob_get_contents();
		ob_end_clean();
	
		return $previous_post_link;
	}
	
	/**
	 * [next_post_link] shortcode
	 * Uses output buffering to avoid rewriting a bunch of code in comments_number() which can only be echo'd
	 * 
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function next_post_link_shortcode( $atts ) {
		// Grabbing parameters and setting default values
		extract(
			shortcode_atts(
				array(
					'text'  => 'Next post link'
				),
				$atts
			)
		);
	
		// Sanitization of text
		$text = esc_html( $text );
	
		ob_start();
		next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', $text, 'coraline' ) . '</span>' );
		$next_post_link = ob_get_contents();
		ob_end_clean();
	
		return $next_post_link;
	}
	
	/**
	 * Sanitize names 
	 * Blitz everything but alpha numerics, _'s or -'s or spaces
	 * 
	 * @since 1.0
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function sanitize_names( $string ) {
		$string = preg_replace( '/[^a-z_0-9-_A-Z-_ ]/', ',' , $string );
		return $string;
	}
	
	/**
	 * Comma delimited list of numbers
	 * 
	 * @since 0.1
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function sanitize_comma_numeric( $str ) {
		$str = preg_replace( '/[^0-9-]/', ',', $str ); // Blitz everything but numbers and commas
		return $str;
	}
	
}
