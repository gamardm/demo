<?php

namespace Shortcake_Inaset\Shortcodes;

class Product_Canvas extends Shortcode {


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
				'label' => esc_html__( 'Description', 'inaset' ),
				'attr'  => 'description',
				'type'  => 'textarea',
			),

			array(
				'label'       => esc_html__( 'Gallery', 'inaset' ),
				'attr'        => 'gallery',
				'description' => esc_html__( 'You can select multiple images.', 'inaset' ),
				'type'        => 'attachment',
				'libraryType' => array( 'image' ),
				'multiple'    => true,
				'addButton'   => 'Select Images',
				'frameTitle'  => 'Select Images',
			),

		);

		/*
		 * Define the Shortcode UI arguments.
		 */
		$shortcode_ui_args = array(
			/*
			 * How the shortcode should be labeled in the UI. Required argument.
			 */
			'label' => esc_html__( 'Product Canvas', 'inaset' ),

			/*
			 * Include an icon with your shortcode. Optional.
			 * Use a dashicon, or full HTML (e.g. <img src="/path/to/your/icon" />).
			 */
			'listItemImage' => 'dashicons-format-gallery',

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
			'image'  => 0,
			'description' => '',
			'gallery' => '',
			'html_id' => ''

		), $attr, $shortcode_tag );

		$html_id = !empty( $attr['html_id'] ) ? 'id="'. esc_attr( $attr['html_id'] ) .'"': '';

		$gallery = explode(',', $attr['gallery'] );

		if( empty( $gallery ) || !is_array( $gallery ) ) {
		    return;
        }

        $images = array();

		foreach ( $gallery as $id ) {
		    $image = get_post( $id );
			$images[] = array(
			    'id' => $id,
                'title' => esc_html( $image->post_title ),
			    'description' => wp_kses_post( wpautop( $image->post_content ) ),
                'sizes' => array(
                        'medium' => wp_get_attachment_image_url( $id, 'medium' ),
                        'full' => $image->guid,
                ),
            );
        }


		wp_localize_script( 'inaset-js', 'INASET_CANVAS', array( 'gallery' => $images ) );

		ob_start(); ?>

            <section class="block-product-canvas js-vue-canvas" <?php echo $html_id; ?>>

                <div class="product-canvas__gallery-large" v-if="canvasIsOpen" v-cloak>
                    <button @click.prevent="closeImage" class="button__close-window" title="<?php esc_html_e( 'Close window', 'inaset' );  ?>"></button>
                    <div class="container">
                        <div class="row row__padded">
                            <div class="column column-lg-3 product-canvas__image-info">
                                <h3>{{ image.title }}</h3>
                                <div v-html="image.description"></div>
                            </div>
                        </div>
                    </div>
                    <div class="background-image">
                        <div class="image" :style="{ backgroundImage: 'url('+ image.sizes.full +')' }"></div>
                    </div>
                </div>

                <div class="container">
                    <div class="row row__padded">
                        <div class="column column-lg-6 product-canvas__gallery">
                            <div class="slider-buttons">
                                <button @click.prevent="scrollLeft" class="button__previous" title="Previous"></button><button @click.prevent="scrollRight" class="button__next" title="Next"></button>
                            </div>
                            <ul v-if="images.length > 0" class="js-scroll-wrapper">
                                <li class="js-scroll-column" v-for="(image, index) in images">
                                    <a href="#" @click.prevent="openImage(index)">
                                        <i class="icon-zoom"></i>
                                        <div class="background-image">
                                            <div class="image" :style="{ backgroundImage: 'url('+ image.sizes.medium +')' }"></div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="column column-lg-5 column__shift-1 product-canvas__description">
                            <?php echo wp_kses_post( wp_get_attachment_image( $attr['image'], 'full', false, array( 'class' => '' ) ) ) ?>
                            <?php echo wpautop( wp_kses_post( $attr['description'] ) ); ?>
                        </div>
                    </div>
                </div>
            </section>



		<?php

		return ob_get_clean();

	}



}
