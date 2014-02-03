<?php

/**
 * Get domain name without "http" & "www". Leave subdomain if no "www". Usually pass in home_url().
 * Purpose is to link to http://www.pinterest.com/source/[domain.com]/
 *
 * @since   1.0.1
 *
 * @return  string
 */
function rrpzl_get_base_domain_name( $url ) {
	//First strip http(s)://
	$url = parse_url( $url, PHP_URL_HOST );
	$url = preg_replace( '#^www\.(.+\.)#i', '$1', $url );

	return $url;
}