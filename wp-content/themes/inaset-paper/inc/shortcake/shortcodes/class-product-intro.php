<?php

namespace Shortcake_Inaset\Shortcodes;

class Product_Intro extends Shortcode {


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
				'label'       => esc_html__( 'Product Logo', 'inaset' ),
				'attr'        => 'logo',
				'type'        => 'attachment',
				'libraryType' => array( 'image' ),
				'addButton'   => esc_html__( 'Select Logo', 'inaset' ),
				'frameTitle'  => esc_html__( 'Select Logo', 'inaset' ),
			),

			array(
				'label' => esc_html__( 'Title', 'inaset' ),
				'attr'  => 'title',
				'type'  => 'text',
			),

			array(
				'label' => esc_html__( 'Description', 'inaset' ),
				'attr'  => 'description',
				'type'  => 'textarea',
			),

			array(
				'label'       => esc_html__( 'Product Image', 'inaset' ),
				'attr'        => 'image',
				'type'        => 'attachment',
				'libraryType' => array( 'image' ),
				'addButton'   => esc_html__( 'Select Image', 'inaset' ),
				'frameTitle'  => esc_html__( 'Select Image', 'inaset' ),
			),

			array(
				'label'       => esc_html__( 'Product Certifications Logos', 'inaset' ),
				'attr'        => 'cert_logos',
				'type'        => 'attachment',
				'libraryType' => array( 'image' ),
				'addButton'   => esc_html__( 'Select Image', 'inaset' ),
				'frameTitle'  => esc_html__( 'Select Image', 'inaset' ),
			),

			array(
				'label' => esc_html__( 'CTA Label', 'inaset' ),
				'attr'  => 'cta_label',
				'type'  => 'text',
			),

		);

		/*
		 * Define the Shortcode UI arguments.
		 */
		$shortcode_ui_args = array(
			/*
			 * How the shortcode should be labeled in the UI. Required argument.
			 */
			'label' => esc_html__( 'Product Intro', 'inaset' ),

			/*
			 * Include an icon with your shortcode. Optional.
			 * Use a dashicon, or full HTML (e.g. <img src="/path/to/your/icon" />).
			 */
			'listItemImage' => 'dashicons-info',

			/*
			 * Limit this shortcode UI to specific posts. Optional.
			 */
			'post_type' => array( 'product' ),

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
			'logo' => 0,
			'image' => 0,
			'cert_logos' => 0,
			'title'  => '',
			'description' => '',
			'cta_label' => '',
			'html_id' => ''

		), $attr, $shortcode_tag );

		$html_id = !empty( $attr['html_id'] ) ? 'id="'. esc_attr( $attr['html_id'] ) .'"': '';

		ob_start(); ?>

			<section class="block-product-intro" <?php echo $html_id; ?>>
				<div class="container">
					<div class="row row__padded">
						<div class="column column-lg-5 product-description">
							<?php echo wp_kses_post( wp_get_attachment_image( $attr['logo'], 'full', false, array( 'class' => 'product-logo' ) ) ) ?>
							<h2><?php echo wp_kses_post( $attr['title'] ); ?></h2>
							<?php echo wpautop( wp_kses_post( $attr['description'] ) ); ?>
						</div>
						<div class="column column-lg-7 product-image">
							<?php echo wp_kses_post( wp_get_attachment_image( $attr['image'], 'full', false, array( 'class' => '', 'data-anim' => 'fadeInUp', 'data-anim-delay' => '250' ) ) ) ?>
						</div>
						<div class="column column-lg-5 column__bottom product-range">
							<a href="#product-range" class="button button__product-range js-scroll-down" data-scroll-to="#product-range" data-scroll-offset="89">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 30">	<path fill-rule="evenodd" d="M23,15 L23,45 L46,45 L46,23.737 L37.5584991,15 L23,15 Z M24.729683,16.7268077 L36.1742899,16.7268077 L36.1742899,24.8008846 L44.2700085,24.8008846 L44.2700085,43.2775385 L24.729683,43.2775385 L24.729683,16.7268077 Z M37.7425383,17.6759615 L43.1137362,23.2372692 L37.7425383,23.2372692 L37.7425383,17.6759615 Z" transform="translate(-23 -15)"/></svg>
								<span><?php echo wp_kses_post( $attr['cta_label'] ); ?></span>
							</a>
						</div>
						<div class="column column-lg-6 column__shift-1 column__bottom product-ream-logos">
							<?php echo wp_kses_post( wp_get_attachment_image( $attr['cert_logos'], 'full', false, array( 'class' => '' ) ) ) ?>
						</div>
					</div>
				</div>
			</section>

		<?php

		return ob_get_clean();
	}

}
