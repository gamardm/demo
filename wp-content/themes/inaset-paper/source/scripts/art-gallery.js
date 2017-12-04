import Vue from 'vue';
import bus from './vue-bus';
import axios from 'axios';
import { horizontalSliderMixin } from './slider';

const serverVars = window.INASET_JS || [];

export default function initArtGallery() {
    "use strict";

    if ( document.querySelector('.js-vue-art-gallery') === null ) {
        return;
    }

    let vm = new Vue({
        el:'.js-vue-art-gallery',
        data: {
            slides: []
        },
        mixins: [ horizontalSliderMixin ],
        mounted() {
            bus.$on( 'art-gallery-selected', this.selectArtSet ); // from navigation.js
        },

        methods: {
            selectArtSet( set ) {
                this.loadServices( set.term_id );
            },
            loadServices( setId ) {

                let vueInst = this;

                axios.get( serverVars.api_route.concat( 'art/' ), {
                    params: {
                        art_set: setId
                    }
                }).then( r => {
                    vueInst.slides = r.data;
                    vueInst.currentSlide = 1;
                    vueInst.init();

                }).catch( e => {
                    console.log( e );
                } );

            },
        },
        computed:{
            slidesLength() {
                return this.slides.length;
            },
            slidesToShow() {
                return 1;
            },
        }
    });

}