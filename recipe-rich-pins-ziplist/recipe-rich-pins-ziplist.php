<?php

/**
 * Recipe Rich Pins for ZipList
 *
 * @package   RRPZL
 * @author    Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license   GPL-2.0+
 * @link      http://pinplugins.com
 * @copyright 2014 Phil Derksen
 *
 * @wordpress-plugin
 * Plugin Name: Recipe Rich Pins for ZipList
 * Plugin URI: http://pinplugins.com/recipe-rich-pins-ziplist/
 * Description: Add recipe rich pin meta data to your ZipList recipes for enhanced pins on Pinterest.
 * Version: 1.0.3
 * Author: Phil Derksen
 * Author URI: http://philderksen.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/pderksen/WP-Recipe-Rich-Pins-ZipList
 * Text Domain: rrpzl
 * Domain Path: /languages/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'RRPZL_MAIN_FILE' ) ) {
	define ( 'RRPZL_MAIN_FILE', __FILE__ );
}

require_once( plugin_dir_path( __FILE__ ) . 'class-recipe-rich-pins-ziplist.php' );

add_action( 'plugins_loaded', array( 'Recipe_Rich_Pins_ZipList', 'get_instance' ) );
