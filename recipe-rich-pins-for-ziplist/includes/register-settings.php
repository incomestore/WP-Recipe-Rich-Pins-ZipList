<?php

/**
 * Register all settings needed for the Settings API.
 *
 * @package    RRPZL
 * @subpackage Includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

/*
 * Register all the plugin settings
 * 
 * @since 1.0.0
 */
function rrpzl_register_settings() {
	$rrpzl_settings = array(
		'general' => array(
		
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

/*
 * Radio button callback function
 * 
 * @since 1.0.0
 */
function rrpzl_radio_callback( $args ) {
	global $rrpzl_options;

	// Return empty string if no options.
	if ( empty( $args['options'] ) ) {
		echo '';
		return;
	}

	$html = "\n";

	foreach ( $args['options'] as $key => $option ) {
		$checked = false;

		if ( isset( $rrpzl_options[ $args['id'] ] ) && $rrpzl_options[ $args['id'] ] == $key )
			$checked = true;
		elseif ( isset( $args['std'] ) && $args['std'] == $key && ! isset( $rrpzl_options[ $args['id'] ] ) )
			$checked = true;

		$html .= '<input name="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']" id="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" type="radio" value="' . $key . '" ' . checked( true, $checked, false ) . '/>' . "\n";
		$html .= '<label for="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>' . "\n";
	}

	// Render and style description text underneath if it exists.
	if ( ! empty( $args['desc'] ) )
		$html .= '<p class="description">' . $args['desc'] . '</p>' . "\n";

	echo $html;
}

/*
 * Single checkbox callback function
 * 
 * @since 1.0.0
 */
function rrpzl_checkbox_callback( $args ) {
	global $rrpzl_options;
	
	$checked = isset( $rrpzl_options[$args['id']] ) ? checked( 1, $rrpzl_options[$args['id']], false ) : '';
	$html = "\n" . '<input type="checkbox" id="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']" name="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']" value="1" ' . $checked . '/>' . "\n";

	// Render description text directly to the right in a label if it exists.
	if ( ! empty( $args['desc'] ) )
		$html .= '<label for="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>' . "\n";

	echo $html;
}

/*
 * Multiple checkboxes callback function
 * 
 * @since 1.0.0
 */
function rrpzl_multicheck_callback( $args ) {
	global $rrpzl_options;

	// Return empty string if no options.
	if ( empty( $args['options'] ) ) {
		echo '';
		return;
	}

	$html = "\n";

	foreach ( $args['options'] as $key => $option ) {
		if ( isset( $rrpzl_options[$args['id']][$key] ) ) { $enabled = $option; } else { $enabled = NULL; }
		$html .= '<input name="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" id="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" type="checkbox" value="' . $option . '" ' . checked($option, $enabled, false) . '/>' . "\n";
		$html .= '<label for="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>' . "\n";
	}

	// Render and style description text underneath if it exists.
	if ( ! empty( $args['desc'] ) )
		$html .= '<p class="description">' . $args['desc'] . '</p>' . "\n";

	echo $html;
}

/*
 * Select box callback function
 * 
 * @since 1.0.0
 */
function rrpzl_select_callback( $args ) {
	global $rrpzl_options;

	// Return empty string if no options.
	if ( empty( $args['options'] ) ) {
		echo '';
		return;
	}

	$html = "\n" . '<select id="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']" name="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']"/>' . "\n";

	foreach ( $args['options'] as $option => $name ) :
		$selected = isset( $rrpzl_options[$args['id']] ) ? selected( $option, $rrpzl_options[$args['id']], false ) : '';
		$html .= '<option value="' . $option . '" ' . $selected . '>' . $name . '</option>' . "\n";
	endforeach;

	$html .= '</select>' . "\n";

	// Render and style description text underneath if it exists.
	if ( ! empty( $args['desc'] ) )
		$html .= '<p class="description">' . $args['desc'] . '</p>' . "\n";

	echo $html;
}

/*
 * Textarea callback function
 * 
 * @since 1.0.0
 */
function rrpzl_textarea_callback( $args ) {
	global $rrpzl_options;

	if ( isset( $rrpzl_options[ $args['id'] ] ) )
		$value = $rrpzl_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	// Ignoring size at the moment.
	$html = "\n" . '<textarea class="large-text" cols="50" rows="10" id="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']" name="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']">' . esc_textarea( $value ) . '</textarea>' . "\n";

	// Render and style description text underneath if it exists.
	if ( ! empty( $args['desc'] ) )
		$html .= '<p class="description">' . $args['desc'] . '</p>' . "\n";

	echo $html;
}

/**
 * Number callback function
 * 
 * @since 1.0.0
 */
function rrpzl_number_callback( $args ) {
	global $rrpzl_options;

	if ( isset( $rrpzl_options[ $args['id'] ] ) )
		$value = $rrpzl_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
	$html = "\n" . '<input type="number" class="' . $size . '-text" id="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']" name="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']" step="1" value="' . esc_attr( $value ) . '"/>' . "\n";

	// Render description text directly to the right in a label if it exists.
	if ( ! empty( $args['desc'] ) )
		$html .= '<label for="rrpzl_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>' . "\n";

	echo $html;
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

	$general_settings = is_array( get_option( 'rrpzl_settings_general' ) ) ? get_option( 'rrpzl_settings_general' )  : array();

	return array_merge( $general_settings );
}

