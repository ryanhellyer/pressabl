<?php

/**
 * @package WordPress
 * @subpackage Pressabl
 *
 * Loads CSS Tidy extension
 * Bulk of code is copied from SafeCSS by Automattic
 */


/**
 * Main class for parsing CSS
 * Much of this code is courtesy of SafeCSS by Automattic and CSSTidy
 * 
 * @since 0.1
 */
class safecss extends csstidy_optimise {


	var $tales = array();
	var $props_w_urls = array(
		'background',
		'background-image',
		'list-style',
		'list-style-image'
	);
	var $allowed_protocols = array( 'http' );

	function safecss( &$css ) {
		return $this->csstidy_optimise( $css );
	}

	function postparse() {
		if ( !empty( $this->parser->import ) )
			$this->parser->import = array();
		if ( !empty( $this->parser->charset ) )
			$this->parser->charset = array();
		return parent::postparse();
	}

	function subvalue() {
		$this->sub_value = trim( $this->sub_value );

		// Send any urls through our filter
		if ( preg_match( '!^\\s*url\\s*(?:\\(|\\\\0028)(.*)(?:\\)|\\\\0029).*$!Dis', $this->sub_value, $matches ) )
			$this->sub_value = $this->safe_clean_url( $matches[1] );

		// Strip any expressions
		if ( preg_match( '!^\\s*expression!Dis', $this->sub_value ) )
			$this->sub_value = '';

		return parent::subvalue();
	}

	function safe_clean_url( $url ) {
		// Clean up the string
		$url = trim( $url, "' \" \r \n" );

		// Check against whitelist for properties allowed to have URL values
		if ( ! in_array( $this->property, $this->props_w_urls ) )
			return '';

		$url = wp_kses_bad_protocol_once( $url, $this->allowed_protocols );

		if ( empty( $url ) )
			return '';

		return "url('$url')";
	}
}

