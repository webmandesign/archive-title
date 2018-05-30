<?php if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;

/**
 * Plugin uninstall actions.
 *
 * @since    1.0.0
 * @version  1.0.0
 */





/**
 * Delete plugin options.
 *
 * Note: We have to use direct option name here
 * as plugin's functions and methods are no longer
 * callable during WordPress plugin uninstall.
 */
delete_option( 'archive_title' );
