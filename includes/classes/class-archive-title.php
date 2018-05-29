<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Plugin main functionality.
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 *   0) Init
 *  10) Functionality
 *  20) Localization
 * 100) Others
 */
class Archive_Title {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		private function __construct() {

			// Helper variables

				if ( ! defined( 'ARCHIVE_TITLE_CSS_CLASS_A11Y' ) ) {
					define( 'ARCHIVE_TITLE_CSS_CLASS_A11Y', 'screen-reader-text' );
				}


			// Processing

				// Setup

					self::load_plugin_textdomain();

				// Hooks

					// Filters

						add_filter( 'get_the_archive_title', __CLASS__ . '::labels' );

		} // /__construct



		/**
		 * Initialization (get instance).
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function init() {

			// Processing

				if ( null === self::$instance ) {
					self::$instance = new self;
				}


			// Output

				return self::$instance;

		} // /init





	/**
	 * 10) Functionality
	 */

		/**
		 * Modify archive page title by removing the label.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $title
		 */
		public static function labels( $title = '' ) {

			// Helper variables

				$labels = (array) Archive_Title_Options::get( 'labels' );

				if ( 'remove-accessibly' === Archive_Title_Options::get( 'labels_action' ) ) {
					$title_new = '<span class="' . esc_attr( ARCHIVE_TITLE_CSS_CLASS_A11Y ) . '">%1$s </span>%2$s';
				} else {
					$title_new = '%2$s';
				}


			// Requirements check

				if ( empty( $labels ) ) {
					return $title;
				}


			// Processing

				if ( in_array( 'is_category', $labels ) && is_category() ) {

					$title = sprintf(
						$title_new,
						esc_html_x( 'Category:', 'Archive title label.', 'archive-title' ),
						single_cat_title( '', false )
					);

				} elseif ( in_array( 'is_tag', $labels ) && is_tag() ) {

					$title = sprintf(
						$title_new,
						esc_html_x( 'Tag:', 'Archive title label.', 'archive-title' ),
						single_tag_title( '', false )
					);

				} elseif ( in_array( 'is_author', $labels ) && is_author() ) {

					$title = sprintf(
						$title_new,
						esc_html_x( 'Author:', 'Archive title label.', 'archive-title' ),
						'<span class="vcard">' . get_the_author() . '</span>'
					);

				} elseif ( in_array( 'is_post_type_archive', $labels ) && is_post_type_archive() ) {

					$title = sprintf(
						$title_new,
						esc_html_x( 'Archives:', 'Archive title label.', 'archive-title' ),
						post_type_archive_title( '', false )
					);

				} elseif ( in_array( 'is_tax', $labels ) && is_tax() ) {

					$tax   = get_taxonomy( get_queried_object()->taxonomy );
					$title = sprintf(
						$title_new,
						$tax->labels->singular_name . ':',
						single_term_title( '', false )
					);

				}


			// Output

				return trim( (string) $title );

		} // /labels





	/**
	 * 20) Localization
	 */

		/**
		 * Load the plugin text domain for translation.
		 *
		 * Loading the plugin translations should not be done during
		 * `plugins_loaded` action since that is too early and prevent
		 * other language related plugins from correctly hooking up with
		 * `load_textdomain()` function and doing whatever they want to do.
		 *
		 * Calling `load_plugin_textdomain()` should be delayed until `init` action!
		 *
		 * @link  https://developer.wordpress.org/reference/functions/load_plugin_textdomain/#comment-1568
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function load_plugin_textdomain() {

			// Processing

				load_plugin_textdomain(
					'archive-title',
					false,
					dirname( plugin_basename( ARCHIVE_TITLE_FILE ) ) . '/languages'
				);

		} // /load_plugin_textdomain





} // /Archive_Title

add_action( 'init', 'Archive_Title::init' );
