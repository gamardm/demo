<?php

namespace Shortcake_Inaset\Shortcodes;

class Intro_Image extends Shortcode {


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
				'label' => esc_html__( 'Text', 'inaset' ),
				'attr'  => 'text',
				'type'  => 'textarea',
			),

			array(
				'label' => esc_html__( 'Link', 'inaset' ),
				'attr'  => 'link_url',
				'type'  => 'url',
			),
			array(
				'label' => esc_html__( 'Link Label', 'inaset' ),
				'attr'  => 'link_label',
				'type'  => 'text',
			)

		);

		/*
		 * Define the Shortcode UI arguments.
		 */
		$shortcode_ui_args = array(
			/*
			 * How the shortcode should be labeled in the UI. Required argument.
			 */
			'label' => esc_html__( 'Page Intro Image', 'inaset' ),

			/*
			 * Include an icon with your shortcode. Optional.
			 * Use a dashicon, or full HTML (e.g. <img src="/path/to/your/icon" />).
			 */
			'listItemImage' => 'dashicons-info',

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
			'text'  => '',
            'link_url' => '',
			'link_label' => '',
			'html_id' => ''
		), $attr, $shortcode_tag );

		$html_id = !empty( $attr['html_id'] ) ? 'id="'. esc_attr( $attr['html_id'] ) .'"': '';

		ob_start(); ?>

            <section class="block-intro" <?php echo $html_id; ?>>
                <div class="container">
	                <?php echo wp_kses_post( wp_get_attachment_image( $attr['image'], 'full', false, array( 'class' => 'awards-trophy' ) ) ); ?>
                    <div class="row row__padded">
                        <div class="column column-lg-8 column__shift-4">
                            <p class="intro-text"><?php echo wp_kses_post( $attr['text'] ); ?></p>
                            <?php if( !empty( $attr['link_url'] ) ) : ?>
                                <a href="<?php echo esc_url( $attr['link_url'] ); ?>" title="<?php echo wp_kses_post( $attr['link_label'] ); ?>" class="button"><?php echo wp_kses_post( $attr['link_label'] ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

		<?php

		return ob_get_clean();
	}

}
