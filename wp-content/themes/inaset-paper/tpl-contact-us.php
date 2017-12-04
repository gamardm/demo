<?php /** Template Name: Contact Us */ ?>

<?php get_header(); ?>

<?php while( have_posts() ) : the_post(); ?>

    <section class="block-contact js-vue-form" v-cloak>
        <div class="background-image">
            <div class="image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');"></div>
        </div>
        <div class="container">
            <div class="row row__padded">
                <div class="column column-lg-10 column__shift-1 column__offset-1">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>
            <div v-if="showMessage" :class="{'form-message__error': showMessage === 'error'}" class="row row__padded">
                <div class="column column-lg-10 column__shift-1 column__offset-1">
                    <p v-if="showMessage === 'success'" v-cloak><?php esc_html_e( 'Your message was sent successfully. Thanks.', 'inaset' ); ?></p>
                    <p v-else-if="showMessage === 'error'" v-cloak><?php esc_html_e( 'Failed to send your message. Please try again later or contact administrator by other way.', 'inaset' ); ?></p>
                </div>
            </div>
            <form v-else @submit.prevent="validateForm" data-form-id="contact" class="contact-form row row__padded" accept-charset="utf-8">
                <div class="column column-lg-5 column__shift-1">
                    <input type="text" name="first" v-model="contact.hpot" class="hide-text">

                    <label for="name"><?php esc_html_e( 'Name', 'inaset' ); ?></label>
                    <input v-model="contact.name" v-validate="'required'" :class="{'validate-error': errors.has('name') }" name="name" id="name" type="text" placeholder="" title="<?php esc_attr_e( 'Name', 'inaset' ); ?>">

                    <label for="email"><?php esc_html_e( 'Email', 'inaset' ); ?></label>
                    <input v-model="contact.email" v-validate="'required|email'" :class="{'validate-error': errors.has('email') }" name="email" id="email" type="email" placeholder="" title="<?php esc_attr_e( 'Email', 'inaset' ); ?>">

                    <label for="telephone"><?php esc_html_e( 'Telephone', 'inaset' ); ?></label>
                    <input v-model="contact.phone" v-validate="'required'" :class="{'validate-error': errors.has('phone') }" name="phone" id="telephone" type="tel" placeholder="" title="<?php esc_attr_e( 'Telephone', 'inaset' ); ?>">

                    <label for="country"><?php esc_html_e( 'Country', 'inaset' ); ?></label>
                    <span class="select" :class="{'validate-error': errors.has('country') }">
						<select v-model="contact.country" v-validate="'required'" name="country" id="country">
							<option value=""><?php esc_html_e( 'Choose a country', 'inaset' ); ?></option>
							<option value="">-</option>
                            <option v-if="countries.length > 0" v-for="country in countries">{{ country.name }}</option>
						</select>
					</span>

                    <label for="city"><?php esc_html_e( 'City', 'inaset' ); ?></label>
                    <input v-model="contact.city" v-validate="'required'" :class="{'validate-error': errors.has('city') }" name="city" id="city" type="text" placeholder="" title="<?php esc_attr_e( 'City', 'inaset' ); ?>">

                    <label for="language"><?php esc_html_e( 'Language', 'inaset' ); ?></label>
                    <span class="select" :class="{'validate-error': errors.has('language') }">
						<select v-model="contact.language" v-validate="'required'" name="language" id="language">
							<option value=""><?php esc_html_e( 'Choose a Language', 'inaset' ); ?></option>
							<option value="">-</option>
                            <option value="en">English</option>
							<option value="pt">Português</option>
						</select>
					</span>
                </div>
                <div class="column column-lg-5 column__offset-1">
                    <label for="company"><?php esc_html_e( 'Company', 'inaset' );  ?></label>
                    <input v-model="contact.company" v-validate="'required'" :class="{'validate-error': errors.has('company') }"  name="company" id="company" type="text" placeholder="" title="<?php esc_attr_e( 'Company', 'inaset' );  ?>">

                    <label for="job"><?php esc_html_e( 'Job', 'inaset' );  ?></label>
                    <input v-model="contact.job" v-validate="'required'" :class="{'validate-error': errors.has('job') }"  name="job" id="job" type="text" placeholder="" title="<?php esc_attr_e( 'Job', 'inaset' );  ?>">

                    <label for="subject"><?php esc_html_e( 'Subject', 'inaset' );  ?></label>
                    <span class="select" :class="{'validate-error': errors.has('subject') }">
						<select v-model="contact.subject" v-validate="'required'" name="subject" id="subject">
                             <?php foreach( inaset_get_contact_us_subject() as $k => $label ): ?>
                                 <option value="<?php echo $k; ?>"><?php echo esc_html( $label ); ?></option>
                             <?php endforeach; ?>
						</select>
					</span>

                    <label for="remarks"><?php esc_html_e( 'Remarks', 'inaset' ); ?></label>
                    <textarea v-model="contact.comment" v-validate="'required'" :class="{'validate-error': errors.has('comment') }" name="comment" id="remarks" title="Remarks"></textarea>

                    <input :disabled="errors.any() || isSubmitting" type="submit" value="<?php esc_html_e( 'Contact Me', 'inaset' ); ?>">
                </div>
            </form>
            <div class="row row__padded">
                <?php get_template_part( 'parts/cta-button', '' ); ?>
            </div>
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>