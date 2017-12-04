/*jshint esversion: 6 */
import Vue from 'vue';
import bus from './vue-bus';

// cookie notice key
const cookieNoticeKey = 'InasetPaperCookieAccepted';

export default function initCookiesNotice() {
    "use strict";

    let vm = new Vue({
        el: '.js-vue-cookie-notice',
        mixins: [ cookieNoticeMixin ],
        watch: {
            showCookieNotice: function( val ) {
                bus.$emit( 'cookie-notice-status', val );
            }
        }
    });
}


const cookieNoticeMixin = {
    data: {
        showCookieNotice: false,
    },
    mounted() {
        this.showCookieNotice = !this.getCookieNotice(); // if cookie was accepted, it returns true, so don't show.
    },
    methods: {
        closeCookieNotice() {
            this.showCookieNotice = false;
            this.setCookieNotice();
        },
        setCookieNotice() {
            try {
                localStorage.setItem( cookieNoticeKey, '1' );
            } catch(e) {}
        },
        getCookieNotice() {
            let storage = false;
            try {
                storage = localStorage.getItem( cookieNoticeKey ) || false;
            } catch(e) {
                return false;
            }
            return storage === '1';
        }
    }
};



