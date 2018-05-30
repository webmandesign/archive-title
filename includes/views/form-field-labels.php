<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Render option form field: "labels", multi-select checkbox group.
 *
 * @return  array
 *
 * @since    1.0.0
 * @version  1.0.0
 */





// Helper variables

	$setting_name  = 'labels';
	$setting_value = (array) Archive_Title_Options::get( $setting_name );
	$items         = (array) Archive_Title_Options::get_option_atts( $setting_name, 'form_field_setup' );


// Output

	// Description

		?>

		<p class="description">
			<?php esc_html_e( 'Select which archive page title labels you want to control.', 'archive-title' ); ?>
		</p>

		<?php

	// Form field

		foreach ( $items as $item => $atts ) :
			?>

			<p>
				<label>
					<input
						type="checkbox"
						name="<?php echo esc_attr( Archive_Title_Options::$option_name . '[' . $setting_name . ']' ); ?>[]"
						value="<?php echo esc_attr( $item ); ?>"
						<?php checked( true, in_array( $item, $setting_value ) ); ?>
						/>
					<?php

					echo '<strong>' . esc_html( $atts['label'] ) . '</strong>';

					if ( isset( $atts['description'] ) ) {
						echo '&ensp; (<span class="description">' . esc_html( $atts['description'] ) . '</span>)';
					}

					?>
				</label>
			</p>

			<?php
		endforeach;
