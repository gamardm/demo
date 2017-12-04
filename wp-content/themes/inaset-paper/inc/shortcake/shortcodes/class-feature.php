<?php

namespace Shortcake_Inaset\Shortcodes;

class Feature extends Shortcode {


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
				'label' => esc_html__( 'Title', 'inaset' ),
				'attr'  => 'title',
				'type'  => 'text',
			),

			array(
				'label' => esc_html__( 'Description', 'inaset' ),
				'attr'  => 'description',
				'type'  => 'textarea',
                'encode' => true
			),

			array(
				'label'       => esc_html__( 'Text Alignment', 'inaset' ),
				'attr'        => 'text_side',
				'type'        => 'radio',
				'options'     => array(
					array( 'value' => 'left', 'label' => esc_html__( 'Left', 'inaset' ) ),
					array( 'value' => 'right', 'label' => esc_html__( 'Right', 'inaset' ) ),
				),
			),

			array(
				'label'       => esc_html__( 'Image', 'inaset' ),
				'attr'        => 'image',
				'type'        => 'attachment',
				'libraryType' => array( 'image' ),
				'addButton'   => esc_html__( 'Select Image', 'inaset' ),
				'frameTitle'  => esc_html__( 'Select Image', 'inaset' ),
			),

			array(
				'label'       => esc_html__( 'Image offset', 'inaset' ),
				'attr'        => 'image_offset',
				'type'        => 'checkbox',
				'options'     => array(
					array( 'value' => true, 'label' => esc_html__( 'with offset', 'inaset' ) ),
				),
			),

			array(
				'label'       => esc_html__( 'Icon', 'inaset' ),
				'attr'        => 'icon',
				'type'        => 'attachment',
				'libraryType' => array( 'image' ),
				'addButton'   => esc_html__( 'Select Icon', 'inaset' ),
				'frameTitle'  => esc_html__( 'Select Icon', 'inaset' ),
			),




		);

		/*
		 * Define the Shortcode UI arguments.
		 */
		$shortcode_ui_args = array(
			/*
			 * How the shortcode should be labeled in the UI. Required argument.
			 */
			'label' => esc_html__( 'Feature', 'inaset' ),

			/*
			 * Include an icon with your shortcode. Optional.
			 * Use a dashicon, or full HTML (e.g. <img src="/path/to/your/icon" />).
			 */
			'listItemImage' => 'dashicons-megaphone',

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
			'icon' => 0,
			'title'  => '',
			'description' => '',
			'text_side' => 'left',
			'image_offset' => false,
			'html_id' => ''

		), $attr, $shortcode_tag );

		$html_id = !empty( $attr['html_id'] ) ? 'id="'. esc_attr( $attr['html_id'] ) .'"': '';

		$class = 'block-feature block-feature__text-'. $attr['text_side'];
		if( $attr['image_offset'] ) {
			$class .= ' block-feature__offset-image';
        }

		ob_start(); ?>

            <section class="<?php echo $class; ?>" <?php echo $html_id; ?>>
                <div class="container">
                    <div class="row row__padded">
                        <div class="column column-lg-5">
                            <h2 data-anim="fadeInUp" data-anim-delay="250"><?php echo wp_kses_post( $attr['title'] ); ?></h2>
	                        <?php echo wp_kses_post( wpautop( $attr['description'] ) ); ?>
                        </div>
                    </div>
                </div>
                <div class="background-image">
	                <?php echo wp_kses_post( wp_get_attachment_image( $attr['icon'], 'full', false, array( 'class' => 'icon' ) ) ) ?>
                    <div class="image" style="background-image: url('<?php echo wp_kses_post( wp_get_attachment_image_url( $attr['image'], 'full' ) ) ?>');"></div>
                </div>
            </section>

		<?php

		return ob_get_clean();
	}

}
