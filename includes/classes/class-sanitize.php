<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Sanitization methods.
 *
 * @link  https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 * 10) Functionality
 */
class Archive_Title_Sanitize {





	/**
	 * 10) Functionality
	 */

		/**
		 * Sanitize checkbox.
		 *
		 * Sanitization callback for checkbox type controls.
		 * This callback sanitizes `$checked` as a boolean value, either TRUE or FALSE.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  bool $value
		 */
		public static function checkbox( $value ) {

			// Output

				return ( ( isset( $value ) && true == $value ) ? ( true ) : ( false ) );

		} // /checkbox



		/**
		 * Sanitize select/radio.
		 *
		 * Sanitization callback for select and radio type controls.
		 * This callback sanitizes `$value` against provided array of `$choices`.
		 * The `$choices` has to be associated array!
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $value
		 * @param  array  $choices
		 * @param  string $default
		 */
		public static function select( $value, $choices = array(), $default = '' ) {

			// Processing

				/**
				 * If we pass a customizer control as `$choices`,
				 * get the list of choices and default value from it.
				 */
				if ( is_a( $choices, 'WP_Customize_Setting' ) ) {
					$default = $choices->default;
					$choices = $choices->manager->get_control( $choices->id )->choices;
				}


			// Output

				return ( array_key_exists( $value, (array) $choices ) ? ( esc_attr( $value ) ) : ( esc_attr( $default ) ) );

		} // /select



		/**
		 * Sanitize array.
		 *
		 * Sanitization callback for multiselect type controls.
		 * This callback sanitizes `$value` against provided array of `$choices`.
		 * The `$choices` has to be associated array!
		 * Returns an array of values.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  mixed $value
		 * @param  array $choices
		 */
		public static function multi_array( $value, $choices = array() ) {

			// Helper variables

				/**
				 * If we get a string in `$value`,
				 * split it to array using `,` as delimiter.
				 */
				$value = ( ! is_array( $value ) ) ? ( explode( ',', (string) $value ) ) : ( $value );

				/**
				 * If we pass a customizer control as `$choices`,
				 * get the list of choices and default value from it.
				 */
				if ( is_a( $choices, 'WP_Customize_Setting' ) ) {
					$choices = $choices->manager->get_control( $choices->id )->choices;
				}


			// Requirements check

				if ( empty( $choices ) ) {
					return array();
				}


			// Processing

				foreach ( $value as $key => $single_value ) {

					if ( ! array_key_exists( $single_value, $choices ) ) {
						unset( $value[ $key ] );
						continue;
					}

					$value[ $key ] = esc_attr( $single_value );

				}


			// Output

				return (array) $value;

		} // /multi_array





} // /Archive_Title_Sanitize
