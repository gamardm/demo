/*jshint esversion: 6 */
import Vue from 'vue';

const sliderVars = window.INASET_SLIDER || [];

export function initSlider() {

    "use strict";

    if ( document.querySelector('.js-vue-slider') === null ) {
        return;
    }

    let vm = new Vue({
        el:'.js-vue-slider',
        mixins: [horizontalSliderMixin],
        data: {
            slides: sliderVars.slides,
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

export const horizontalSliderMixin = {
    data() {
        return {
            originalSlidesLength: 0,
            currentSlide: 1,
            timer: null,
            rotationDelay: 5000,
            el: {
                // list: null,
                container: null,
                track: null,
                slides: null
            },
            transform: 0,
            transitionDelay: 0,
            width: {
                //document: 0,
                container: 0,
                slide: 0,
                track: 0
            },
            speed: 600, // transition speed
        }
    },
    mounted() {
        this.el.container = this.$el.querySelector('.js-slider-container');
        this.el.track = this.$el.querySelector('.js-slider-track');

        this.$nextTick( this.init );

    },
    beforeDestroy() {
        this.stopRotation();
        window.removeEventListener( 'visibilitychange', this.onVisibilityChange );
        window.removeEventListener( 'resize', this.getWidth );
        this.el.track.removeEventListener( 'mouseover', this.stopRotation );
        this.el.track.removeEventListener( 'mouseout', this.startRotation );
    },

    methods: {
        init() {
            this.originalSlidesLength = this.slidesLength;

            this.slides.unshift( this.slides[ this.slidesLength -1 ] ); // copy the last slide to the slides list
            this.slides.push( this.slides[1] ); // copy the first slide to the slides list

            // Get width on start
            this.getWidth();

            window.addEventListener( 'visibilitychange', this.onVisibilityChange );
            window.addEventListener( 'resize', this.getWidth );


            // Mouse and touch events
            /*if ('ontouchstart' in window) {
                this.el.track.addEventListener('touchstart', this.handleMouseDown)
                this.el.track.addEventListener('touchend', this.handleMouseUp)
                this.el.track.addEventListener('touchmove', this.handleMouseMove)
            } else {
                this.el.track.addEventListener('mousedown', this.handleMouseDown)
                this.el.track.addEventListener('mouseup', this.handleMouseUp)
                this.el.track.addEventListener('mousemove', this.handleMouseMove)
            }*/
            this.el.track.addEventListener( 'mouseover', this.stopRotation );
            this.el.track.addEventListener( 'mouseout', this.startRotation );


            this.startRotation();

        },
        startRotation() {
            if (this.timer !== null) {
                this.stopRotation();
            }
            this.timer = setInterval( this.next, this.rotationDelay );
        },

        stopRotation() {
            if (this.timer !== null) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },

        getWidth () {
            let containerWidth = this.el.container.clientWidth;

            this.width = {
                container: containerWidth,
                slide: containerWidth / this.slidesToShow,
            };

            // Prepare track
            this.width.track = this.width.slide * this.slidesLength;
            this.goToSlide( this.currentSlide, false, false );
        },

        prev() {
            this.goToSlide( this.currentSlide - 1 );
        },

        next() {
            this.goToSlide( this.currentSlide + 1 );
        },

        goToSlide( slide, transition = true, resetRotation = true ) {

            this.transform = slide * this.width.slide;
            //this.transform += this.width.slide;

            if ( !transition ) {
                this.transitionDelay = 0;
            } else {
                this.transitionDelay = this.speed;
            }

            if ( slide <= 0 ) {
                this.currentSlide = this.originalSlidesLength - 1;
                setTimeout( () => {
                    this.goToSlide( this.originalSlidesLength - 1, false )
                }, this.speed );
            } else if( slide > this.originalSlidesLength ) {
                this.currentSlide = 1;
                setTimeout( () => {
                    this.goToSlide( 1, false )
                }, this.speed );
            } else {
                this.currentSlide = slide;
            }

            if ( resetRotation ) {
                this.startRotation();
            }
        },

        onVisibilityChange() {
            if ( document.hidden ) {
                this.stopRotation();
            } else {
                this.startRotation();
            }
        },
    },
};



