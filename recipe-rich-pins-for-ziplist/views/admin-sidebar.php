<?php

/**
 * Sidebar portion of the administration dashboard view.
 *
 * @package    RRPZL
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;
?>

<div class="sidebar-container">
	<div class="sidebar-content">
		<p>
			<?php _e( "Help us get noticed (and boost our egos) with a rating and short review.", 'rrpzl' ); ?>
		</p>

		<a href="http://wordpress.org/support/view/plugin-reviews/rrpzlroad" class="btn btn-small btn-block btn-inverse" target="_blank">
			<?php _e( 'Rate this plugin on WordPress.org', 'rrpzl' ); ?></a>
	</div>
</div>

<div class="sidebar-container">
	<h3 class="sidebar-title-large"><?php _e( 'Need more Pinterest traffic?', 'rrpzl' ); ?></h3>

	<div class="sidebar-content">
		<p>
			<?php _e( 'Check out our Pinterest "Pin It" Button plugin. Now with <strong>' . rrpzl_get_pib_downloads() . '</strong> downloads!', 'rrpzl' ); ?>
		</p>

		<p class="small-text">
			<a href="<?php echo add_query_arg( array(
					'tab'  => 'search',
					'type' => 'term',
					's'    => urlencode('"pinterest pin it button"')
				), admin_url( 'plugin-install.php' ) ); ?>" class="btn btn-small btn-block btn-danger">
				<?php _e( 'Get the Free "Pin It" Button plugin', 'rrpzl' ); ?></a><br/>
			<a href="http://wordpress.org/plugins/pinterest-pin-it-button/" target="_blank"><?php _e( 'Visit the "Pin It" Button plugin page', 'rrpzl' ); ?></a>
		</p>
	</div>
</div>
