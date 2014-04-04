<?php

/**
 * Represents the view for the post meta options.
 *
 * @package    RRPZL
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$rrpzl_permalink   = get_permalink( $post->ID );

$base_domain = rrpzl_get_base_domain_name( home_url() );

?>

<p>
	<strong>
		<a href="http://developers.pinterest.com/rich_pins/validator/?link=<?php echo urlencode( $rrpzl_permalink ); ?>" target="_blank">
			<?php _e( 'Validate this Post with Pinterest', 'rrpzl' ); ?>
		</a>&nbsp;&nbsp;|&nbsp;
		<a href="http://www.pinterest.com/source/<?php echo $base_domain; ?>" target="_blank">
			<?php _e( 'View recent pins for ' . $base_domain, 'rrpzl' ); ?>
		</a>
	</strong>
</p>
