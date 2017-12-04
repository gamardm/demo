/*jshint esversion: 6 */
import Vue from 'vue';
import { scrollHorizontalMixin } from './scroll-horizontal';

const canvasImages = window.INASET_CANVAS || {};

export default function initProductCanvas() {
    "use strict";

    if ( document.querySelector('.js-vue-canvas') === null ) {
        return;
    }

    let vm = new Vue({
        el:'.js-vue-canvas',
        mixins: [scrollHorizontalMixin],
        data: {
            images: canvasImages.gallery,
            image: null,
            canvasIsOpen: false,

        },
        created() {
            this.image = this.images[0];
        },
        methods: {
            openImage( index ) {
                this.image = this.images[ index ];
                this.canvasIsOpen = true;
            },
            closeImage() {
                this.canvasIsOpen = false;
            },
        },
        computed: {
            countColumns() {
                return this.images.length;
            },
            countVisibleColumns() {
                return 1;
            }
        },


    });


}

