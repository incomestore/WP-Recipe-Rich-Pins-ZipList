<?php

/**
 * Get domain name without "http" & "www". Leave subdomain if no "www". Usually pass in home_url().
 * Purpose is to link to http://www.pinterest.com/source/[domain.com]/
 *
 * @since   1.0.0
 *
 * @return  string
 */
function rrpzl_get_base_domain_name( $url ) {
	//First strip http(s)://
	$url = parse_url( $url, PHP_URL_HOST );
	$url = preg_replace( '#^www\.(.+\.)#i', '$1', $url );

	return $url;
}

/**
 * Function to return the number of PIB Lite downloads from wordpress.org
 * 
 * @since 1.0.0
 * 
 */
function rrpzl_get_pib_downloads() {
	
	require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
	
	$plugin_info = plugins_api( 'plugin_information', array( 'slug' => 'pinterest-pin-it-button' ) );
	
	return number_format_i18n( $plugin_info->downloaded );
}