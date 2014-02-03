<?php
/**
 * Main Recipe Rich Pins for ZipList class
 *
 * @package RRPZL
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

class Recipe_Rich_Pins_For_ZipList {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */

	/**************************************
	 * UPDATE VERSION HERE
	 * and main plugin file header comments
	 * and README.txt changelog
	 **************************************/

	const VERSION = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'recipe-rich-pins-for-ziplist';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {
		
		// Load includes
		add_action( 'init', array( $this, 'includes' ), 1 );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add plugin listing "Settings" action link.
		add_filter( 'plugin_action_links_' . plugin_basename( plugin_dir_path( __FILE__ ) . $this->plugin_slug . '.php' ), array( $this, 'settings_link' ) );
		
		// Calls for Post Meta stuff
		add_action( 'add_meta_boxes', array( $this, 'display_post_meta') );
		add_action( 'save_post', array( $this, 'save_meta_data') );
		
		// Add admin notice after plugin activation. Also check if should be hidden.
		add_action( 'admin_notices', array( $this, 'admin_install_notice' ) );
		
		// Admin CSS
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		
	}
	
	/**
	 * Includes necessary files
	 *
	 * @since     1.0.0
	 *
	 */
	public function includes() {
		
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Returns the plugin title
	 *
	 * @since    1.0.0
	 */
	public static function get_plugin_title() {
		return __( 'Recipe Rich Pins for ZipList', 'rrpzl' );
	}
	
	/*
	 * Load admin CSS files
	 * 
	 * @since 1.0.0
	 */
	function enqueue_admin_styles() {
		if( $this->viewing_this_plugin() ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), self::VERSION );
		}
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		// Add Settings submenu item
		$this->plugin_screen_hook_suffix[] = add_submenu_page(
			'options-general.php',
			$this->get_plugin_title(),
			__( 'Recipe Rich Pins', 'rrpzl' ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}
	
	/**
	 * Add Settings action link to left of existing action links on plugin listing page.
	 *
	 * @since   1.0.0
	 *
	 * @param   array  $links  Default plugin action links.
	 * @return  array  $links  Amended plugin action links.
	 */
	public function settings_link( $links ) {
		$setting_link = sprintf( '<a href="%s">%s</a>', add_query_arg( 'page', $this->plugin_slug, admin_url( 'admin.php' ) ), __( 'Settings', 'rrpzl' ) );
		array_unshift( $links, $setting_link );

		return $links;
	}
	
	/**
	 * Check if viewing one of this plugin's admin pages.
	 *
	 * @since   1.0.0
	 *
	 * @return  bool
	 */
	private function viewing_this_plugin() {
		if ( ! isset( $this->plugin_screen_hook_suffix ) )
			return false;

		$screen = get_current_screen();

		if ( in_array( $screen->id, $this->plugin_screen_hook_suffix ) )
			return true;
		else
			return false;
	}

	/**
	 * Show notice after plugin install/activate in admin dashboard until user acknowledges.
	 * Also check if user chooses to hide it.
	 *
	 * @since   1.0.0
	 */
	public function admin_install_notice() {
		
	}
	
	/**
	 * Render the post meta for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_post_meta() {
			
	}
	
	
	/**
	 * Save the post meta for this plugin.
	 *
	 * @since    1.0.0
	 *
	 * @param   int  $post_id
	 * @return  int  $post_id
	 */
	public function save_meta_data( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		return $post_id;
	}
}
