<?php
/**
 * @package WordPress
 * @subpackage Pressabl
 * @since Pressabl 0.1
 *
 * Header template
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
