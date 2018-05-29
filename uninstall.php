<?php if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;

/**
 * Plugin uninstall actions.
 *
 * @since    1.0.0
 * @version  1.0.0
 */

delete_option( 'archive_title' ); // We have to use direct names here!
