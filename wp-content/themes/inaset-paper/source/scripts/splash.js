/*jshint esversion: 6 */
import Vue from 'vue';
import bus from './vue-bus';

// splash session key
const splashKey = 'InasetPaperSplash';

export default function initSplash() {
    "use strict";

    if( document.querySelector( '.js-vue-splash') === null ) {
        return;
    }

    let blockHome = document.querySelector( '.js-block-home' );

    let vm = new Vue({
        el: '.js-vue-splash',

        data: {
            showSplash: true,
        },
        mounted() {
            this.showSplash = this.getSplashCookie();

            if( this.showSplash && blockHome ) {
                blockHome.style.display = 'none';
            } else {
                blockHome.style.display = 'block';
            }
        },
        methods: {
            continueToMain() {
                blockHome.style.display = 'block';
                this.showSplash = false;
                this.setSplashCookie();
            },
            setSplashCookie() {
                try {
                    sessionStorage.setItem( splashKey, '1' );
                } catch(e) {}
            },
            getSplashCookie() {
                let storage;
                try {
                    storage = sessionStorage.getItem( splashKey ) || false;
                } catch(e) {
                    return true;
                }
                return storage !== '1';
            }
        },
        watch: {
            showSplash: function( val ) {
                bus.$emit( 'splash-screen-status', val );
            }
        }
    });
}
