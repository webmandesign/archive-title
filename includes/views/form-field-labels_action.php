<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Render option form field: "labels_action", radio buttons.
 *
 * @return  string
 *
 * @since    1.0.0
 * @version  1.0.0
 */





// Helper variables

	$setting_name  = 'labels_action';
	$setting_value = (string) Archive_Title_Options::get( $setting_name );
	$items         = (array) Archive_Title_Options::get_option_atts( $setting_name, 'form_field_setup' );


// Output

	// Description

		?>

		<p class="description">
			<?php esc_html_e( 'Select how the selected labels should be treated.', 'archive-title' ); ?>
		</p>

		<?php

	// Form field

		foreach ( $items as $item => $atts ) :
			?>

			<p>
				<label>
					<input
						type="radio"
						name="<?php echo esc_attr( Archive_Title_Options::$option_name . '[' . $setting_name . ']' ); ?>"
						value="<?php echo esc_attr( $item ); ?>"
						<?php checked( $item, $setting_value ); ?>
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
