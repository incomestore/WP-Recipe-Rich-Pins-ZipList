<?php

/**
 *  Admin settings page update notices.
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
 * Display save settings message in the admin
 * 
 * @since 1.0.0
 */
function rrpzl_register_admin_notices() { 
	
	if ( ( isset( $_GET['page'] ) && 'recipe-rich-pins-ziplist' == $_GET['page'] ) && ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) ) {
		add_settings_error( 'rrpzl-notices', 'rrpzl-general-updated', __( 'Settings updated.', 'rrpzl' ), 'updated' );
	}

}
add_action( 'admin_notices', 'rrpzl_register_admin_notices' );
