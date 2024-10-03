<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Plugin Name:  Archive Title by WebMan
 * Plugin URI:   https://www.webmandesign.eu/portfolio/archive-title-wordpress-plugin/
 * Description:  Provides options to control an archive page title.
 * Version:      1.0.2
 * Author:       WebMan Design, Oliver Juhas
 * Author URI:   https://www.webmandesign.eu/
 * License:      GPL-3.0-or-later
 * License URI:  http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:  archive-title
 * Domain Path:  /languages
 *
 * Requires PHP:       7.0
 * Requires at least:  6.0
 *
 * @copyright  WebMan Design, Oliver Juhas
 * @license    GPL-3.0, https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @link  https://github.com/webmandesign/archive-title
 * @link  https://www.webmandesign.eu
 *
 * @package  Archive Title
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Constants.
define( 'ARCHIVE_TITLE_FILE', __FILE__ );
define( 'ARCHIVE_TITLE_PATH', plugin_dir_path( ARCHIVE_TITLE_FILE ) ); // Trailing slashed.
/**
 * define( 'ARCHIVE_TITLE_CSS_CLASS_A11Y', 'screen-reader-text' );
 * @see  includes/classes/class-archive-title.php/Archive_Title->__construct()
 */

// Load the functionality.
require_once ARCHIVE_TITLE_PATH . 'includes/classes/class-archive-title.php';
require_once ARCHIVE_TITLE_PATH . 'includes/classes/class-options.php';
