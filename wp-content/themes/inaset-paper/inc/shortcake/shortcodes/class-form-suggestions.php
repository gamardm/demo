<?php

namespace Shortcake_Inaset\Shortcodes;

class Form_Suggestions extends Shortcode {


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
				'label' => esc_html__( 'Text', 'inaset' ),
				'attr'  => 'text',
				'type'  => 'textarea',
			),

		);

		/*
		 * Define the Shortcode UI arguments.
		 */
		$shortcode_ui_args = array(
			/*
			 * How the shortcode should be labeled in the UI. Required argument.
			 */
			'label' => esc_html__( 'Form Suggestions', 'inaset' ),

			/*
			 * Include an icon with your shortcode. Optional.
			 * Use a dashicon, or full HTML (e.g. <img src="/path/to/your/icon" />).
			 */
			'listItemImage' => 'dashicons-forms',

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
			'text'  => '',
            'title' => '',
			'html_id' => ''
		), $attr, $shortcode_tag );

		$html_id = !empty( $attr['html_id'] ) ? 'id="'. esc_attr( $attr['html_id'] ) .'"': '';

		ob_start(); ?>

            <section class="block-suggestions-form js-vue-form" <?php echo $html_id; ?>>
                <div class="container">
                    <div class="row row__padded">
                        <div class="column column-lg-4">
                            <h2 data-anim="fadeInUp" data-anim-delay="250"><?php echo wp_kses_post( $attr['title'] ); ?></h2>
                            <?php if( !empty( $attr['text'] ) ) : ?>
                                <?php echo wp_kses_post( wpautop( $attr['text'] ) ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="column column-lg-5 column__shift-2 column__offset-1">
                            <div v-if="showMessage" :class="{'form-message__error': showMessage === 'error'}">
                                <p v-if="showMessage === 'success'" v-cloak><?php esc_html_e( 'Your suggestion was sent successfully. Thanks.', 'inaset' ); ?></p>
                                <p v-else-if="showMessage === 'error'" v-cloak><?php esc_html_e( 'Failed to send your suggestion. Please try again later or contact administrator by other way.', 'inaset' ); ?></p>
                            </div>
                            <form @submit.prevent="validateForm" class="suggestions-form" accept-charset="utf-8" data-form-id="suggestion" v-else>
                                <input type="text" name="first" v-model="contact.hpot" class="hide-text">

                                <label for="name" class="hide-text"><?php esc_html_e( 'Your name', 'inaset' ); ?></label>
                                <input v-model="contact.name" v-validate="'required'" :class="{'validate-error': errors.has('name') }" id="name" name="name" type="text" placeholder="<?php esc_attr_e( 'Your name', 'inaset' ); ?>" title="<?php esc_attr_e( 'Your name', 'inaset' ); ?>">

                                <label for="email" class="hide-text"><?php esc_html_e( 'Your email', 'inaset' ); ?></label>
                                <input v-model="contact.email" v-validate="'required|email'" :class="{'validate-error': errors.has('email') }" id="email" name="email" type="email" placeholder="<?php esc_attr_e( 'Your email', 'inaset' ); ?>" title="<?php esc_attr_e( 'Your email', 'inaset' ); ?>">

                                <label for="url" class="hide-text"><?php esc_html_e( 'URL of the site where is your suggestion', 'inaset' ); ?></label>
                                <input v-model="contact.url" v-validate="'url'" :class="{'validate-error': errors.has('url') }" id="url" name="url" type="url" placeholder="<?php esc_attr_e( 'URL of the site where is your suggestion', 'inaset' ); ?>" title="<?php esc_attr_e( 'URL of the site where is your suggestion', 'inaset' ); ?>">

                                <label for="reason" class="hide-text"><?php esc_html_e( 'Why am I making this suggestion?', 'inaset' ); ?></label>
                                <input v-model="contact.comment" v-validate="'required'" :class="{'validate-error': errors.has('comment') }" name="comment" id="reason" type="text" placeholder="<?php esc_attr_e( 'Why am I making this suggestion?', 'inaset' ); ?>" title="<?php esc_attr_e( 'Why am I making this suggestion?', 'inaset' ); ?>">

                                <input type="submit" :disabled="errors.any() || isSubmitting"  value="<?php esc_html_e( 'Send suggestion', 'inaset' );  ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </section>

		<?php

		return ob_get_clean();
	}

}
