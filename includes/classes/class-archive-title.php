<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Plugin main functionality.
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Page title
 * 20) Getters
 * 30) Localization
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

			// Processing

				// Setup

					self::load_plugin_textdomain();

					if ( ! defined( 'ARCHIVE_TITLE_CSS_CLASS_A11Y' ) ) {
						/**
						 * Defining `ARCHIVE_TITLE_CSS_CLASS_A11Y` constant conditionally
						 * here in `init` action hook so a possible (child) theme definition
						 * can be picked up first.
						 */
						define( 'ARCHIVE_TITLE_CSS_CLASS_A11Y', 'screen-reader-text' );
					}

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
	 * 10) Page title
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
					$title_sprintf = '<span class="' . esc_attr( ARCHIVE_TITLE_CSS_CLASS_A11Y ) . '">%1$s </span>%2$s';
				} else {
					$title_sprintf = '%2$s';
				}


			// Requirements check

				if ( empty( $labels ) ) {
					return $title;
				}


			// Processing

				$labels = array_intersect(
					$labels,
					(array) Archive_Title_Options::get_option_atts( 'labels' )
				);

				foreach ( $labels as $archive ) {
					if (
						is_callable( $archive )
						&& call_user_func( $archive )
					) {
						$title = call_user_func( __CLASS__ . '::get_title_' . $archive, $title_sprintf );
						break;
					}
				}


			// Output

				return trim( (string) $title );

		} // /labels





	/**
	 * 20) Getters
	 */

		/**
		 * Get modified title: Category.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $title_sprintf  Format: %1$s = "Category:", %2$s = category title.
		 */
		public static function get_title_is_category( $title_sprintf ) {

			// Output

				return sprintf(
					$title_sprintf,
					esc_html_x( 'Category:', 'Archive title label.', 'archive-title' ),
					single_cat_title( '', false )
				);

		} // /get_title_is_category



		/**
		 * Get modified title: Tag.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $title_sprintf  Format: %1$s = "Tag:", %2$s = tag title.
		 */
		public static function get_title_is_tag( $title_sprintf ) {

			// Output

				return sprintf(
					$title_sprintf,
					esc_html_x( 'Tag:', 'Archive title label.', 'archive-title' ),
					single_tag_title( '', false )
				);

		} // /get_title_is_tag



		/**
		 * Get modified title: Author.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $title_sprintf  Format: %1$s = "Author:", %2$s = author name.
		 */
		public static function get_title_is_author( $title_sprintf ) {

			// Output

				return sprintf(
					$title_sprintf,
					esc_html_x( 'Author:', 'Archive title label.', 'archive-title' ),
					'<span class="vcard">' . get_the_author() . '</span>'
				);

		} // /get_title_is_author



		/**
		 * Get modified title: Custom post type.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $title_sprintf  Format: %1$s = "Archives:", %2$s = post type title.
		 */
		public static function get_title_is_post_type_archive( $title_sprintf ) {

			// Output

				return sprintf(
					$title_sprintf,
					esc_html_x( 'Archives:', 'Archive title label.', 'archive-title' ),
					post_type_archive_title( '', false )
				);

		} // /get_title_is_post_type_archive



		/**
		 * Get modified title: Custom taxonomy.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $title_sprintf  Format: %1$s = taxonomy name, %2$s = taxonomy term title.
		 */
		public static function get_title_is_tax( $title_sprintf ) {

			// Helper variables

				$tax = get_taxonomy( get_queried_object()->taxonomy );


			// Output

				return sprintf(
					$title_sprintf,
					$tax->labels->singular_name . ':',
					single_term_title( '', false )
				);

		} // /get_title_is_tax





	/**
	 * 30) Localization
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
