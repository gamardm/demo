/*jshint esversion: 6 */
import Vue from 'vue';
import VeeValidate from 'vee-validate';
import axios from 'axios';
import countries from './countries';

// Used to validate forms
Vue.use( VeeValidate );

const serverVars = window.INASET_JS || {};

export default function initFormsVue() {

    if( document.querySelector( '.js-vue-form' ) === null ) {
        return;
    }

    // bind Vue logic
    let vm = new Vue({
        el: '.js-vue-form',
        data: {

            isSubmitting: false,

            showMessage: false, // success, error

            // contact form
            contact: {
                hpot: '', // honeypot
                name: '',
                email: '',
                url: '',
                comment: '', // also used for remarks

                phone: '',
                country: '',
                city: '',
                language: '',
                company: '',
                job: '',
                subject: '',
            },

            countries: countries,
        },
        methods: {

            // Submit Checkout
            validateForm(e) {
                let now = new Date();
                let data = {
                    title: this.contact.name,
                    timestamp: now.getTime() / 1000,
                    content: '',
                    status: 'unread',
                    contact: this.contact,
                    form_type: e.target.getAttribute('data-form-id'),
                };

                this.$validator.validateAll().then( function() {

                    if( data.contact.email.length <= 0 ) {
                        return;
                    }

                    vm.isSubmitting = true;

                    vm.submitContent( data );

                }, function(){
                    console.log('error form');
                });

            },

            submitContent( data ) {

                if( data.contact.hpot !== '' ) {
                    this.showMessage = 'success';
                    return;
                }

                let request = axios.create({
                    headers: { 'X-WP-Nonce': serverVars.nonce_rest }
                });

                data.status = 'unread';

                request.post( serverVars.api_route.concat( 'contact/' ), data )
                    .then( (response) => {
                        vm.showMessage = 'success';
                    })
                    .catch( (error) => {
                        vm.showMessage = 'error';
                        console.log(error);
                    })
                    .then( () => {
                        vm.isSubmitting = false;
                    });

            }

        },

    });

} // end initFormsVue
