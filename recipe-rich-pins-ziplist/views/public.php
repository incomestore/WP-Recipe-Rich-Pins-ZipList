<?php
/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   RRPZL
 * @author    Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license   GPL-2.0+
 * @copyright 2014 Phil Derksen
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Add og:site_name to the header of the site
 * 
 * @since 1.0.0
 */
function rrpzl_add_og_site_name() {
	
	global $rrpzl_options;
	
	if( ! empty( $rrpzl_options['og_site_name'] ) ) {
		echo '<meta property="og:site_name" content="' . esc_attr( $rrpzl_options['og_site_name'] ) . '" />' . "\n";
	}
}
add_action( 'wp_head', 'rrpzl_add_og_site_name' );

/*
 * Add URL itemprop to the header of the page
 * 
 * @since 1.0.0
 */
function rrpzl_add_url() {
	
	global $post;
	
	$permalink = get_permalink( $post->ID );
	
	echo '<meta itemprop="url" href="' . $permalink . '" />';
}
add_action( 'wp_head', 'rrpzl_add_url' );
