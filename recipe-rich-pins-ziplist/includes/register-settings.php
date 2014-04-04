<?php

/**
 * Register all settings needed for the Settings API.
 *
 * @package    RRPZL
 * @subpackage Includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/*
 * Register all the plugin settings
 * 
 * @since 1.0.0
 */
function rrpzl_register_settings() {
	$rrpzl_settings = array(
		'general' => array(
			'og_site_name' => array(
				'id'       => 'og_site_name',
				'name'     => __( 'Open Graph Site Name', 'rrpzl' ),
				'desc'     => __( 'A site-wide Open Graph tag (<code>og:site_name</code>) is recommended by Pinterest since <a href="http://www.schema.org" target="_blank">Schema.org</a> doesn\'t support a site name field. ', 'rrpzl' ) .
					__( 'If another plugin is already generating this tag (such as WordPress SEO), you can clear out this value to prevent duplicate output.', 'rrpzl' ),
				'type'     => 'text',
				'size'     => 'regular-text'
			)
		)
	);

	/* If the options do not exist then create them for each section */
	if ( false == get_option( 'rrpzl_settings_general' ) ) {
		add_option( 'rrpzl_settings_general' );
	}

	/* Add the General Settings section */
	add_settings_section(
		'rrpzl_settings_general',
		__( 'General Settings', 'rrpzl' ),
		'__return_false',
		'rrpzl_settings_general'
	);
	
	foreach ( $rrpzl_settings['general'] as $option ) {
		add_settings_field(
			'rrpzl_settings_general[' . $option['id'] . ']',
			$option['name'],
			function_exists( 'rrpzl_' . $option['type'] . '_callback' ) ? 'rrpzl_' . $option['type'] . '_callback' : 'rrpzl_missing_callback',
			'rrpzl_settings_general',
			'rrpzl_settings_general',
			rrpzl_get_settings_field_args( $option, 'general' )
		);
	}

	/* Register all settings or we will get an error when trying to save */
	register_setting( 'rrpzl_settings_general',         'rrpzl_settings_general',         'rrpzl_settings_sanitize' );

}
add_action( 'admin_init', 'rrpzl_register_settings' );

/*
 * Return generic add_settings_field $args parameter array.
 *
 * @since     2.0.0
 *
 * @param   string  $option   Single settings option key.
 * @param   string  $section  Section of settings apge.
 * @return  array             $args parameter to use with add_settings_field call.
 */
function rrpzl_get_settings_field_args( $option, $section ) {
	$settings_args = array(
		'id'      => $option['id'],
		'desc'    => $option['desc'],
		'name'    => $option['name'],
		'section' => $section,
		'size'    => isset( $option['size'] ) ? $option['size'] : null,
		'options' => isset( $option['options'] ) ? $option['options'] : '',
		'std'     => isset( $option['std'] ) ? $option['std'] : ''
	);

	// Link label to input using 'label_for' argument if text, textarea, password, select, or variations of.
	// Just add to existing settings args array if needed.
	if ( in_array( $option['type'], array( 'text', 'select', 'textarea', 'password', 'number' ) ) ) {
		$settings_args = array_merge( $settings_args, array( 'label_for' => 'rrpzl_settings_' . $section . '[' . $option['id'] . ']' ) );
	}

	return $settings_args;
}

/**
 * Textbox callback function
 * Valid built-in size CSS class values:
 * small-text, regular-text, large-text
 * 
 * @since 1.0.0
 */
function rrpzl_text_callback( $args ) {
	global $rrpzl_options;

	if ( isset( $rrpzl_options[ $args['id'] ] ) )
		$value = $rrpzl_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : '';
	$html = "\n" . '<input type="text" class="' . $size . '" id="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']" name="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']" value="' . esc_attr( $value ) . '"/>' . "\n";

	// Render and style description text underneath if it exists.
	if ( ! empty( $args['desc'] ) )
		$html .= '<p class="description">' . $args['desc'] . '</p>' . "\n";

	echo $html;
}

/*
 * Function we can use to sanitize the input data and return it when saving options
 * 
 * @since 1.0.0
 */
function rrpzl_settings_sanitize( $input ) {
	add_settings_error( 'rrpzl-notices', '', '', '' );
	return $input;
}

/*
 *  Default callback function if correct one does not exist
 * 
 * @since 1.0.0
 */
function rrpzl_missing_callback( $args ) {
	printf( __( 'The callback function used for the <strong>%s</strong> setting is missing.', 'rrpzl' ), $args['id'] );
}

/*
 * Function used to return an array of all of the plugin settings
 * 
 * @since 1.0.0
 */
function rrpzl_get_settings() {
	
	// Setup our defaults and tell the plugin it has already ran so we don't override options later
	
	if( ! get_option( 'rrpzl_settings_loaded' ) ) {
		
		// Default save settings option to on
		$general = get_option( 'rrpzl_settings_general' );
		
		$general['og_site_name'] = get_bloginfo( 'title' );
		
		update_option( 'rrpzl_settings_general', $general );
		
		// Add option so we know defaults have been set
		add_option( 'rrpzl_settings_loaded', 1 );
		
	}
	
	$general_settings = is_array( get_option( 'rrpzl_settings_general' ) ) ? get_option( 'rrpzl_settings_general' )  : array();

	return array_merge( $general_settings );
}

