<?php

/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package    RRPZL
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $rrpzl_options;

?>

<div class="wrap">

	<div id="rrpzl-settings">
		<div id="rrpzl-settings-content">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

			<div id="container">

				<form method="post" action="options.php">
					<?php
						settings_fields( 'rrpzl_settings_general' );
						do_settings_sections( 'rrpzl_settings_general' );
					
						submit_button();
					?>
				</form>
			</div><!-- #container -->

		</div><!-- #rrpzl-settings-content -->
		
		<div id="rrpzl-settings-sidebar">
			<?php include_once( 'admin-sidebar.php' ); ?>
		</div>
	</div>

</div><!-- .wrap -->
