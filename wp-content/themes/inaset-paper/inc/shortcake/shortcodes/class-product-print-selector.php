<?php

namespace Shortcake_Inaset\Shortcodes;

class Product_Print_Selector extends Shortcode {


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

		);

		/*
		 * Define the Shortcode UI arguments.
		 */
		$shortcode_ui_args = array(
			/*
			 * How the shortcode should be labeled in the UI. Required argument.
			 */
			'label' => esc_html__( 'Product Applications', 'inaset' ),

			/*
			 * Include an icon with your shortcode. Optional.
			 * Use a dashicon, or full HTML (e.g. <img src="/path/to/your/icon" />).
			 */
			'listItemImage' => 'dashicons-dashboard',

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
			'title' => '',
			'html_id' => ''

		), $attr, $shortcode_tag );

		$html_id = !empty( $attr['html_id'] ) ? 'id="'. esc_attr( $attr['html_id'] ) .'"': '';

		$post = get_post();

		$product_app_list  = get_post_meta( $post->ID, 'product_app_list', true );

		$product_app_grammages = get_post_meta( $post->ID, 'product_app_grammages', true );

		if( empty( $product_app_grammages ) || !is_array( $product_app_grammages ) ) {
		    return;
        }

		wp_localize_script( 'inaset-js', 'INASET_PRINTSELCT', array( 'grammages' => $product_app_grammages, 'apps' => $product_app_list ) );

		ob_start(); ?>

            <section class="block-product-print-selector js-vue-print-selector" <?php echo $html_id; ?> v-cloak>
                <div class="container">
                    <div class="row row__padded">
                        <div class="column column-lg-6">
                            <h2><?php echo wp_kses_post( $attr['title'] ); ?></h2>
                        </div>
                        <div class="column column-lg-4 column__shift-1 column__offset-1">
                        <span class="select print-selector">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 30">	<path fill-rule="evenodd" d="M23,15 L23,45 L46,45 L46,23.737 L37.5584991,15 L23,15 Z M24.729683,16.7268077 L36.1742899,16.7268077 L36.1742899,24.8008846 L44.2700085,24.8008846 L44.2700085,43.2775385 L24.729683,43.2775385 L24.729683,16.7268077 Z M37.7425383,17.6759615 L43.1137362,23.2372692 L37.7425383,23.2372692 L37.7425383,17.6759615 Z" transform="translate(-23 -15)"/></svg>
                            <select v-model="active">
                                <option v-for="(app, index) in apps" :value="index">{{ app.title }}</option>
                            </select>
                        </span>
                        </div>
                        <div class="column column-lg-6">
                            <p><strong>{{activeTitle}}</strong></p>
                            <p>{{activeDescription}}</p>
                        </div>
                        <div class="column column-lg-5 column__shift-1">
                            <ul class="grammage-indicators">
                                <li v-for="activeGrammage in activeGrammages" :class="{'disabled': activeGrammage.disabled }">{{ activeGrammage.label }} <span>g/m<sup>2</sup></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

		<?php

		return ob_get_clean();

	}



}
