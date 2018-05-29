<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Plugin Name:  Archive Title by WebMan
 * Plugin URI:   https://www.webmandesign.eu/portfolio/archive-title-wordpress-plugin/
 * Description:  Provides options to control an archive page title.
 * Version:      0.9.0
 * Author:       WebMan Design, Oliver Juhas
 * Author URI:   https://www.webmandesign.eu/
 * License:      GNU General Public License v3
 * License URI:  http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:  archive-title
 * Domain Path:  /languages
 *
 * @copyright  WebMan Design, Oliver Juhas
 * @license    GPL-3.0, https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @link  https://www.webmandesign.eu/portfolio/archive-title-wordpress-plugin/
 * @link  https://github.com/webmandesign/archive-title
 * @link  https://www.webmandesign.eu
 *
 * @package  Archive Title
 *
 * @todo  Sanitize.
 * @todo  Check all TODOs.
 * @todo  Readme file content (only .TXT).
 * @todo  Check all files before submitting.
 */





/**
 * Constants
 */

	define( 'ARCHIVE_TITLE_FILE', __FILE__ );
	define( 'ARCHIVE_TITLE_PATH', plugin_dir_path( ARCHIVE_TITLE_FILE ) ); // Trailing slashed.





/**
 * Load the functionality
 */

	// Main plugin functionality

		require_once ARCHIVE_TITLE_PATH . 'includes/classes/class-archive-title.php';
		require_once ARCHIVE_TITLE_PATH . 'includes/classes/class-options.php';
		require_once ARCHIVE_TITLE_PATH . 'includes/classes/class-sanitize.php';
