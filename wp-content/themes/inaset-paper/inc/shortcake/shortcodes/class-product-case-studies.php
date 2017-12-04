<?php

namespace Shortcake_Inaset\Shortcodes;

class Product_Case_Studies extends Shortcode {


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

		);

		/*
		 * Define the Shortcode UI arguments.
		 */
		$shortcode_ui_args = array(
			/*
			 * How the shortcode should be labeled in the UI. Required argument.
			 */
			'label' => esc_html__( 'Case Studies Slider', 'inaset' ),

			/*
			 * Include an icon with your shortcode. Optional.
			 * Use a dashicon, or full HTML (e.g. <img src="/path/to/your/icon" />).
			 */
			'listItemImage' => 'dashicons-portfolio',

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
			'html_id' => ''

		), $attr, $shortcode_tag );

		$html_id = !empty( $attr['html_id'] ) ? 'id="'. esc_attr( $attr['html_id'] ) .'"': '';

		$post = get_post();

		$slides  = get_post_meta( $post->ID, 'slides', true );

		if( empty( $slides ) || !is_array( $slides ) ) {
			return;
		}

		foreach ( $slides as $k => $slide ) {
		    $slides[ $k ]['description'] = wp_kses_post( wpautop( $slide['description'] ) );
        }

		wp_localize_script( 'inaset-js', 'INASET_SLIDER', array( 'slides' => $slides ) );

		ob_start(); ?>

            <section class="block-case-studies js-vue-slider" <?php echo $html_id; ?> v-cloak>

                <div class="slider-navigation">
                    <a href="#" v-for="n in originalSlidesLength" :class="{'button__slider':1,'slide-item__current': n === currentSlide }" @click.prevent="goToSlide( n )" role="button"></a>
                </div>

                <div class="slider js-slider-container">

                    <div class="js-slider-track" :style="{ width: width.track + 'px', transform: 'translate(-' + transform + 'px)', transition: 'transform ease ' + transitionDelay + 'ms'}">
                        <div :class="{'slide-item':1,'slide-item__current': index === currentSlide }" v-for="(slide,index) in slides" :style="{ width: width.slide + 'px'}">
                            <div class="container">
                                <div class="row row__padded">
                                    <div class="column column-lg-5 slide-content">
                                        <h3>{{ slide.title }}</h3>
                                        <div v-html="slide.description"></div>
                                        <img :src="slide.overlay" v-if="slide.overlay_id !== '' ">
                                    </div>
                                </div>
                            </div>
                            <div class="background-image">
                                <div class="image" :style="{ backgroundImage: 'url('+ slide.background +')' }"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </section>

		<?php

		return ob_get_clean();

	}



}
