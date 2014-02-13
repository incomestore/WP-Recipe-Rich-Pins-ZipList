<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package RRPZL
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'rrpzl_settings_general' );
delete_option( 'rrpzl_settings_loaded' );