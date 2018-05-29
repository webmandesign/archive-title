<?php if ( ! defined( 'WPINC' ) ) exit;

/**
 * Render "labels_action" option form field (checkbox group, multi-select).
 *
 * @since    1.0.0
 * @version  1.0.0
 */





$setting_name  = 'labels';
$setting_value = (array) Archive_Title_Options::get( $setting_name );

$items = array(

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

);



?>

<p class="description">
	<?php esc_html_e( 'Select which archive page title labels you want to control.', 'archive-title' ); ?>
</p>

<?php



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
				echo ' &ensp;(<span class="description">' . esc_html( $atts['description'] ) . '</span>)';
			}

			?>
		</label>
	</p>

	<?php
endforeach;
