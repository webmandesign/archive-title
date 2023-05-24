<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Plugin options.
 *
 * @since    1.0.0
 * @version  1.0.1
 *
 * Contents:
 *
 *   0) Init
 *  10) Options
 *  20) Sanitize
 *  30) Getters
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
					self::$option_name,
					array(
						'sanitize_callback' => __CLASS__ . '::sanitize',
					)
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
	 * 20) Sanitize
	 */

		/**
		 * Sanitize/validate plugin options.
		 *
		 * @since    1.0.0
		 * @version  1.0.1
		 *
		 * @param  array $options
		 */
		public static function sanitize( $options = array() ) {

			// Helper variables

				$allowed_keys = array(
					'labels'        => 'array',
					'labels_action' => 'text',
				);


			// Processing

				$options = array_intersect_key( (array) $options, $allowed_keys );

				foreach ( $allowed_keys as $key => $sanitize_type ) {
					$allowed_value = (array) self::get_option_atts( $key );

					if (
						'text' === $sanitize_type
						&& in_array( $options[ $key ], $allowed_value )
					) {

						/**
						 * Sanitizing a text value:
						 * 1. check if it can be found in a valid values array,
						 * 2. even then apply the `sanitize_text_field()`.
						 */
						$options[ $key ] = sanitize_text_field( $options[ $key ] );

					} elseif ( 'array' === $sanitize_type ) {

						/**
						 * Sanitizing an array of multiple values:
						 * 1. strip the value array to contain only valid values,
						 */
						$options[ $key ] = array_intersect(
							(array) $options[ $key ],
							$allowed_value
						);
						/**
						 * 2. sanitize each value in array with `sanitize_text_field`.
						 */
						$options[ $key ] = array_map(
							'sanitize_text_field',
							(array) $options[ $key ]
						);

					} else {

						/**
						 * Well, the option value does not sanitize to our needs, so,
						 * sorry, but it goes out! (In that case a default value will
						 * be loaded with `self::get()` method.)
						 */
						unset( $options[ $key ] );

					}
				}


			// Output

				return $options;

		} // /sanitize





	/**
	 * 30) Getters
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
				} elseif ( isset( self::$defaults[ $option ] ) ) {
					return self::$defaults[ $option ];
				} else {
					return null;
				}

		} // /get



		/**
		 * Get option attributes.
		 *
		 * Returns option attributes such as valid values or form field setup.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $option
		 * @param  string $get
		 */
		public static function get_option_atts( $option, $get = 'valid_values' ) {

			// Helper variables

				$output = false;
				$values = array(

					'labels' => array(

						'valid_values' => array(
							'is_author',
							'is_category',
							'is_post_type_archive',
							'is_tag',
							'is_tax',
						),

						'form_field_setup' => array(
							'is_author' => array(
								'label'       => __( 'Author archive', 'archive-title' ),
								'description' => __( 'The "Author:" label.', 'archive-title' ),
							),
							'is_category' => array(
								'label'       => __( 'Category archive', 'archive-title' ),
								'description' => __( 'The "Category:" label.', 'archive-title' ),
							),
							'is_post_type_archive' => array(
								'label'       => __( 'Post type archive', 'archive-title' ),
								'description' => __( 'The "Archive:" label.', 'archive-title' ),
							),
							'is_tag' => array(
								'label'       => __( 'Tag archive', 'archive-title' ),
								'description' => __( 'The "Tag:" label.', 'archive-title' ),
							),
							'is_tax' => array(
								'label'       => __( 'Taxonomy archive', 'archive-title' ),
								'description' => __( 'The "Taxonomy name:" label.', 'archive-title' ) . ' ' . __( 'Every custom taxonomy has a different name.', 'archive-title' ),
							),
						),

					),

					'labels_action' => array(

						'valid_values' => array(
							'remove',
							'remove-accessibly',
						),

						'form_field_setup' => array(
							'remove' => array(
								'label' => __( 'Remove labels', 'archive-title' ),
							),
							'remove-accessibly' => array(
								'label'       => __( 'Hide labels accessibly', 'archive-title' ),
								'description' => __( 'Keeps labels readable for assistive technology.', 'archive-title' ) . ' ' .sprintf(
									__( 'Please make sure your theme provides styles for the "%s" CSS class.', 'archive-title' ),
									ARCHIVE_TITLE_CSS_CLASS_A11Y
								),
							),
						),

					),

				);


			// Processing

				if ( isset( $values[ $option ] ) ) {
					$output = $values[ $option ];
				}


			// Output

				if ( isset( $output[ $get ] ) ) {
					return $output[ $get ];
				} else {
					return $output['values'];
				}

		} // /get_option_atts





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
