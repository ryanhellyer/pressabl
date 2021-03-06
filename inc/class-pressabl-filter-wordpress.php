<?php

/**
 * Filter built-in WordPress functions
 * Improves core WordPress and/or cleans things up to make them
 * more extensible within the Pressabl framework
 * 
 * @copyright Copyright (c), PixoPoint
 * @license http://www.gnu.org/licenses/gpl.html GPL
 * @author Ryan Hellyer <ryan@pixopoint.com>
 * @since 1.0
 */
class Pressabl_Filter_WordPress extends Pressabl {

	/**
	 * Constructor
	 * Add methods to appropriate hooks and filters
	 * @since 1.0
	 */
	public function __construct() {
		add_filter( 'gallery_style', array( $this, 'settings_remove_gallery_css' ) );
		add_filter( 'wp_title',      array( $this, 'title' ), 1 );
		add_filter( 'wp_nav_menu',   array( $this, 'menufilter' ) );
		add_filter( 'wp_page_menu',  array( $this, 'menufilter' ) );
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
	 * @author Ryan Hellyer <ryan@pixopoint.com>
	 * @return string
	 */
	public function title() {
		$title = '';
	
		// Single post
		if ( is_single() ) {
			$title .= single_post_title( '', false );
			$title .= ' | ';
			$title .= get_bloginfo( 'name' );
		}
	
		// Home page
		elseif ( is_home() ) {
			$title .= get_bloginfo( 'name' );
			$title .= ' | ';
			$title .= get_bloginfo( 'description' );
			if ( get_query_var( 'paged' ) )
				$title .= ' | ' . __( 'Page', 'pressabl' ) . ' ' . get_query_var( 'paged' );
		}
	
		// Static page
		elseif ( is_page() ) {
			$title .= single_post_title( '', false );
			$title .= ' | ';
			$title .= get_bloginfo( 'name' );
		}
	
		// Search page
		elseif ( is_search() ) {
			$title .= get_bloginfo( 'name' );
			$title .= ' | Search results for ' . esc_html( $s ); 
			if ( get_query_var( 'paged' ) )
				$title .= ' | ' . __( 'Page', 'pressabl' ) . ' ' . get_query_var( 'paged' );
		}
	
		// 404 not found error
		elseif ( is_404() ) {
			$title .= get_bloginfo( 'name' );
			$title .= ' | ' . __( 'Not Found', 'pressabl' );
		}
	
		// Anything else
		else {
			$title .= get_bloginfo( 'name' );
			if ( get_query_var( 'paged' ) )
				$title .= ' | ' . __( 'Page', 'pressabl' ) . ' ' . get_query_var( 'paged' );
		}

		return $title;
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

}
