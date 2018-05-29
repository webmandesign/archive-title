<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Render "labels_action" option form field (radio buttons).
 *
 * @since    1.0.0
 * @version  1.0.0
 */





$setting_name  = 'labels_action';
$setting_value = (string) Archive_Title_Options::get( $setting_name );

$items = array(

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

);



?>

<p class="description">
	<?php esc_html_e( 'Select how the selected labels should be treated.', 'archive-title' ); ?>
</p>

<?php



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
				echo ' &ensp;(<span class="description">' . esc_html( $atts['description'] ) . '</span>)';
			}

			?>
		</label>
	</p>

	<?php
endforeach;
