<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Plugin options.
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 *   0) Init
 *  10) Options
 *  20) Getters
 * 100) Others
 */
class Archive_Title_Options {





	/**
	 * 0) Init
	 */

		public static $admin_page = 'options-reading.php';

		public static $option_name    = 'archive_title';
		public static $option_section = 'archive_title_options';

		public static $options  = array();
		public static $defaults = array(
			'labels'        => array( 'is_post_type_archive' ),
			'labels_action' => 'remove-accessibly',
		);

		private static $instance;



		/**
		 * Constructor.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						add_action( 'admin_init', __CLASS__ . '::register_options' );

					// Filters

						add_filter( 'plugin_action_links_' . plugin_basename( ARCHIVE_TITLE_FILE ), __CLASS__ . '::plugin_action_links' );

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
	 * 10) Options
	 */

		/**
		 * Register setting options.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function register_options() {

			// Helper variables

				$admin_page_id = str_replace(
					array( 'options-', '.php' ),
					'',
					self::$admin_page
				);


			// Processing

				register_setting(
					$admin_page_id,
					self::$option_name
				);

				add_settings_section(
					self::$option_section,
					esc_html__( 'Archive Title Options', 'archive-title' ),
					'__return_empty_string',
					$admin_page_id
				);

					add_settings_field(
						'labels',
						esc_html__( 'Archive title labels', 'archive-title' ),
						__CLASS__ . '::form_field_' . 'labels',
						$admin_page_id,
						self::$option_section
					);

					add_settings_field(
						'labels_action',
						esc_html__( 'Archive title labels action', 'archive-title' ),
						__CLASS__ . '::form_field_' . 'labels_action',
						$admin_page_id,
						self::$option_section
					);

		} // /register_options



		/**
		 * Form field renderer: labels.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function form_field_labels() {

			// Processing

				require_once ARCHIVE_TITLE_PATH . 'includes/views/form-field-labels.php';

		} // /form_field_labels



		/**
		 * Form field renderer: labels_action.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function form_field_labels_action() {

			// Processing

				require_once ARCHIVE_TITLE_PATH . 'includes/views/form-field-labels_action.php';

		} // /form_field_labels_action





	/**
	 * 20) Getters
	 */

		/**
		 * Get a specific plugin option.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $option
		 */
		public static function get( $option ) {

			// Helper variables

				$option = (string) $option;


			// Processing

				if ( empty( self::$options ) ) {
					self::$options = (array) get_option( self::$option_name, self::$defaults );
				}


			// Output

				if ( isset( self::$options[ $option ] ) ) {
					return self::$options[ $option ];
				} else {
					return null;
				}

		} // /get





	/**
	 * 100) Others
	 */

		/**
		 * Set plugin action links.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $links
		 */
		public static function plugin_action_links( $links ) {


			// Processing

				$links[] = '<a href="' . esc_url( get_admin_url( null, self::$admin_page ) ) . '">'
				         . esc_html_x( 'Settings', 'Plugin action link.', 'archive-title' )
				         . '</a>';


			// Output

				return $links;

		} // /plugin_action_links





} // /Archive_Title_Options

add_action( 'init', 'Archive_Title_Options::init' );
