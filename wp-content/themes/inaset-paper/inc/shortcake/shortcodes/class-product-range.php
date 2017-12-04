<?php

namespace Shortcake_Inaset\Shortcodes;

class Product_Range extends Shortcode {


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
				'label' => esc_html__( 'Subtitle', 'inaset' ),
				'attr'  => 'subtitle',
				'type'  => 'text',
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
				'label' => esc_html__( 'Other Notes', 'inaset' ),
				'attr'  => 'notes',
				'type'  => 'textarea',
				'encode' => true,
			),

		);

		/*
		 * Define the Shortcode UI arguments.
		 */
		$shortcode_ui_args = array(
			/*
			 * How the shortcode should be labeled in the UI. Required argument.
			 */
			'label' => esc_html__( 'Product Range', 'inaset' ),

			/*
			 * Include an icon with your shortcode. Optional.
			 * Use a dashicon, or full HTML (e.g. <img src="/path/to/your/icon" />).
			 */
			'listItemImage' => 'dashicons-editor-table',

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
			'title'  => '',
			'subtitle' => '',
			'description' => '',
			'notes' => '',
			'html_id' => ''

		), $attr, $shortcode_tag );

		$html_id = !empty( $attr['html_id'] ) ? 'id="'. esc_attr( $attr['html_id'] ) .'"': '';

		$post = get_post();

		$grammages = get_post_meta( $post->ID , 'product_range_grammages', true );
		$grammages = explode(',', $grammages );
		$grammages_count = count( $grammages );
		$columns = get_post_meta( $post->ID , 'product_range_columns', true );

		if( empty( $grammages ) || empty( $columns ) || !is_array( $grammages ) ) {
		    return '';
        }

		ob_start(); ?>

            <section class="block-product-range js-vue-scroll-horizontal" <?php echo $html_id; ?>>
                <div class="container">
                    <div class="row row__padded">
                        <div class="column column-lg-5">
                            <p class="sub-title"><?php echo wp_kses_post( $attr['subtitle'] ); ?></p>
                            <h2><?php echo wp_kses_post( $attr['title'] ); ?></h2>
                            <?php echo wpautop( wp_kses_post( $attr['description'] ) ); ?>
                        </div>
                        <div class="column column-lg-6 column__shift-1">
                            <div class="slider-buttons">
                                <button @click.prevent="scrollLeft" class="button__previous" title="Previous"></button><button @click.prevent="scrollRight" class="button__next" title="Next"></button>
                            </div>

                            <div class="product-range-table">
                                <div class="product-range__grammage">
                                    <?php foreach( $grammages as $grammage ): ?>
                                        <div><?php echo trim( $grammage ); ?></div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="product-range__sizes-wrapper js-scroll-wrapper">
                                    <?php foreach( $columns as $col ):
                                        $cells = self::sanitize_range_column( $col, $grammages_count );
                                        $column_header = array_shift( $cells ); ?><div class="product-range__sizes js-scroll-column">
                                            <div><?php echo esc_html( trim( $column_header ) ); ?></div>
                                            <?php foreach( $cells as $cell ):
                                                $label = trim( $cell ) == 'y' ? 'yes' : 'no'; ?>
                                                <div><i class="product-range__<?php echo $label; ?>"><span class="hide-text"><?php echo $label; ?></span></i></div>
                                            <?php endforeach; ?>
                                    </div><?php endforeach; ?>
                                </div>
                            </div>

                            <?php if( !empty( $attr['notes'] ) ): ?>

                                <div class="product-range-notes">
	                                <?php echo wpautop( wp_kses_post( $attr['notes'] ) ); ?>
                                </div>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </section>

		<?php

        return ob_get_clean();
	}

	private static function sanitize_range_column( $col = '', $count ) {

		$cells = explode(',', $col );
		$total = count( $cells );

		if( empty( $cells ) || !is_array( $cells ) || $total < 2 ) {
		    return array();
        }

		$filler = array_fill( $total, $count - $total, $cells[ $total - 1 ] );

		return array_merge( $cells, $filler );

    }

}
