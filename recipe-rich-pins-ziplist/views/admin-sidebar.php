<?php

/**
 * Sidebar portion of the administration dashboard view.
 *
 * @package    RRPZL
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( ! rrpzl_is_pib_pro_active() ): // If "Pin It" Button Pro is already active don't show. ?>

	<!-- Use some built-in WP admin theme styles. -->

	<div class="sidebar-container metabox-holder">
		<div class="postbox">
			<h3 class="wp-ui-primary"><span><?php _e( 'Need an awesome "Pin It" button?', 'rrpzl' ); ?></span></h3>
			<div class="inside">
				<div class="main">
					<ul>
						<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Add "Pin It" buttons on image hover', 'rrpzl' ); ?></li>
						<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Add "Pin It" buttons under images', 'rrpzl' ); ?></li>
						<li><div class="dashicons dashicons-yes"></div> <?php _e( '30 custom "Pin It" button designs', 'rrpzl' ); ?></li>
						<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Upload your own button designs', 'rrpzl' ); ?></li>
						<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Twitter, Facebook & G+ buttons', 'rrpzl' ); ?></li>
						<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Use with featured images', 'rrpzl' ); ?></li>
						<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Use with custom post types', 'rrpzl' ); ?></li>

						<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Automatic updates & email support', 'rrpzl' ); ?></li>
					</ul>

					<p class="last-blurb centered">
						<?php _e( 'Get all of these and more with Pinterest "Pin It" Button Pro!', 'rrpzl' ); ?>
					</p>

					<div class="centered">
						<a href="<?php echo rrpzl_ga_campaign_url( PINPLUGIN_BASE_URL . 'pin-it-button-pro/', 'recipe_rich_pins', 'sidebar_link', 'pro_upgrade' ); ?>"
						   class="button-primary button-large" target="_blank">
							<?php _e( 'Get "Pin It" Pro Now', 'rrpzl' ); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif; // End "Pin It" Button Pro check. ?>

<div class="sidebar-container metabox-holder">
	<div class="postbox">
		<div class="inside">
			<p>
				<?php _e( 'Now accepting 5-star reviews! It only takes seconds and means a lot.', 'rrpzl' ); ?>
			</p>
			<div class="centered">
				<a href="http://wordpress.org/support/view/plugin-reviews/recipe-rich-pins-ziplist" class="button-primary" target="_blank">
					<?php _e( 'Rate this Plugin Now', 'rrpzl' ); ?></a>
			</div>
		</div>
	</div>
</div>

<div class="sidebar-container metabox-holder">
	<div class="postbox">
		<div class="inside">
			<ul>
				<li>
					<div class="dashicons dashicons-arrow-right-alt2"></div>
					<a href="http://wordpress.org/support/plugin/recipe-rich-pins-ziplist" target="_blank">
						<?php _e( 'Community Support Forums', 'rrpzl' ); ?></a>
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="sidebar-container metabox-holder">
	<div class="postbox">
		<h3><?php _e( 'Recent News from pinplugins.com', 'rrpzl' ); ?></h3>
		<div class="inside">
			<?php rrpzl_rss_news(); ?>
		</div>
	</div>
</div>
