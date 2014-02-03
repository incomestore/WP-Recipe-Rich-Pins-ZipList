<?php
/**
 * Recipe Rich Pins for ZipList
 *
 * @package   RRPZL
 * @author    Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2014 Phil Derksen
 *
 * @wordpress-plugin
 * Plugin Name: Recipe Rich Pins for ZipList
 * Plugin URI: 
 * Description: 
 * Version: 1.0.0
 * Author: Phil Derksen
 * Author URI: http://philderksen.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

// Require the main class file
require_once( plugin_dir_path( __FILE__ ) . 'class-recipe-rich-pins-for-ziplist.php' );


add_action( 'plugins_loaded', array( 'Recipe_Rich_Pins_For_ZipList', 'get_instance' ) );
