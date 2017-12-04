import Vue from 'vue';

export const scrollHorizontalMixin = {
    data: {
        scroll: 0,
    },
    mounted() {
        window.addEventListener( 'resize', this.resetScroll );
    },
    beforeDestroy() {
        window.removeEventListener( 'resize', this.resetScroll );
    },
    watch: {
        scroll() {
            let scrollWrapper = this.$el.querySelector('.js-scroll-wrapper');
            let childWidth = scrollWrapper.querySelector('.js-scroll-column').clientWidth;
            scrollWrapper.scrollLeft = this.scroll * childWidth;
        }
    },
    methods: {
        resetScroll() {
            this.scroll = 0;
        },
        scrollLeft() {
            this.scroll = this.scroll - 1 <= 0 ? 0 : this.scroll - 1;
        },
        scrollRight() {
            this.scroll = this.scroll >= this.countColumns - this.countVisibleColumns ? this.scroll : this.scroll + 1;
        }
    }
};

export function initScrollHorizontal() {
    "use strict";

    if ( document.querySelector('.js-vue-scroll-horizontal') === null ) {
        return;
    }

    let vm = new Vue({
        el:'.js-vue-scroll-horizontal',
        mixins: [scrollHorizontalMixin],
        computed: {
            countColumns() {
                return this.$el.querySelectorAll('.js-scroll-column').length;
            },
            countVisibleColumns() {
                return 3;
            }
        },
    });

}