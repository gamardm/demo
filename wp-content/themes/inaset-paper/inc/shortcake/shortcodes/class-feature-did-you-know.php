<?php

namespace Shortcake_Inaset\Shortcodes;

class Feature_Did_You_Know extends Shortcode {


	public static function get_shortcode_ui_args() {

		/*
		 * Define the UI for attributes of the shortcode.
		 *
		 * Each array must include 'attr', 'type', and 'label'.
		 * * 'attr' should be the name of the attribute.
		 * * 'type' options include: text, checkbox, textarea, radio, select, email,
		 *     url, number, and date, post_select, attachment, color.
		 * * 'label' is the label text associated with that input field.
		 *
		 * Use 'meta' to add arbitrary attributes to the HTML of the field.
		 *
		 * Use 'encode' to encode attribute data. Requires customization in shortcode callback to decode.
		 *
		 * Depending on 'type', additional arguments may be available.
		 */
		$fields = array(

			array(
				'label'       => esc_html__( 'Image', 'inaset' ),
				'attr'        => 'image',
				'type'        => 'attachment',
				'libraryType' => array( 'image' ),
				'addButton'   => esc_html__( 'Select Image', 'inaset' ),
				'frameTitle'  => esc_html__( 'Select Image', 'inaset' ),
			),

			array(
				'label' => esc_html__( 'Left text', 'inaset' ),
				'attr'  => 'left',
				'type'  => 'textarea',
			),

			array(
				'label' => esc_html__( 'Right text', 'inaset' ),
				'attr'  => 'right',
				'type'  => 'textarea',
			),

			array(
				'label'       => esc_html__( 'Icon 1', 'inaset' ),
				'attr'        => 'icon_1',
				'type'        => 'attachment',
				'libraryType' => array( 'image' ),
				'addButton'   => esc_html__( 'Select Image', 'inaset' ),
				'frameTitle'  => esc_html__( 'Select Image', 'inaset' ),
			),


			array(
				'label'       => esc_html__( 'Icon 2', 'inaset' ),
				'attr'        => 'icon_2',
				'type'        => 'attachment',
				'libraryType' => array( 'image' ),
				'addButton'   => esc_html__( 'Select Image', 'inaset' ),
				'frameTitle'  => esc_html__( 'Select Image', 'inaset' ),
			),



		);

		/*
		 * Define the Shortcode UI arguments.
		 */
		$shortcode_ui_args = array(
			/*
			 * How the shortcode should be labeled in the UI. Required argument.
			 */
			'label' => esc_html__( 'Did You Know', 'inaset' ),

			/*
			 * Include an icon with your shortcode. Optional.
			 * Use a dashicon, or full HTML (e.g. <img src="/path/to/your/icon" />).
			 */
			'listItemImage' => 'dashicons-welcome-learn-more',

			/*
			 * Limit this shortcode UI to specific posts. Optional.
			 */
			'post_type' => array( 'page' ),

			/*
			 * Define the UI for attributes of the shortcode. Optional.
			 *
			 * See above, to where the the assignment to the $fields variable was made.
			 */
			'attrs' => $fields,
		);

		return $shortcode_ui_args;

	}


	public static function callback( $attr, $content = '', $shortcode_tag = '' ) {

		$attr = shortcode_atts( array(
            'image' => 0,
			'icon_1' => 0,
			'icon_2' => 0,
			'left' => '',
			'right' => '',
			'html_id' => ''
		), $attr, $shortcode_tag );

		$html_id = !empty( $attr['html_id'] ) ? 'id="'. esc_attr( $attr['html_id'] ) .'"': '';

		ob_start(); ?>

            <section class="block-feature-didyouknow" <?php echo $html_id; ?>>
                <div class="container">
                    <div class="row row__padded">
                        <div class="column column-lg-4 column__shift-1">
                            <p><?php echo wp_kses_post( $attr['left'] ); ?></p>
                        </div>
                        <div class="column column-lg-4 column__shift-3">
                            <p class="intro-text" data-anim="fadeInUp" data-anim-delay="250"><?php echo wp_kses_post( $attr['right'] ); ?></p>
                            <?php echo wp_kses_post( wp_get_attachment_image( $attr['icon_1'], 'full', false, array( 'class' => 'icon' ) ) ) ?>
                            <?php echo wp_kses_post( wp_get_attachment_image( $attr['icon_2'], 'full', false, array( 'class' => 'icon' ) ) ) ?>
                        </div>
                    </div>
                </div>
                <div class="background-image">
                    <div class="image" style="background-image: url('<?php echo wp_kses_post( wp_get_attachment_image_url( $attr['image'], 'full' ) ) ?>');"></div>
                </div>
            </section>

		<?php

		return ob_get_clean();
	}

}
