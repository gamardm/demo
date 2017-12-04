/*jshint esversion: 6 */
import Vue from 'vue';
import scrollMonitor from 'scrollmonitor';
import { getViewPort, getWindowScrollTop } from './helpers';
import bus from './vue-bus';
import { smoothScroll } from './helpers';

const artMenu = window.INASET_ART_MENU || [];



export default function initNavigation() {
    "use strict";
    let watcher = null;
    const mobileViewPort = 1024;

    let vm = new Vue({
        el:'.js-vue-nav',
        data: {
            mainIsOpen: false,
            mainIsFixed: false,
            isMobile: false,
            scroll: 0,
            // Art Gallery Menu
            artSets: artMenu.sets || [],
            currentArtSet: null,
            cookieIsOpen: false,
            splashIsOpen: false,

        },
        mounted() {
            let nextSection = document.getElementById( 'js-trigger-menu' );
            if( nextSection !== null ) {
                let vueInst = this;
                watcher = scrollMonitor.create( nextSection );
                watcher.visibilityChange( function() {
                    vueInst.toggleMainFixed();
                });
            }
            window.addEventListener( 'resize', this.onWindowResize );
            window.addEventListener( 'scroll', this.onWindowScroll );
            this.onWindowResize();
            this.scroll = getWindowScrollTop();
            if( this.artSets.length > 0 ) {
                this.currentArtSet = 0;
            }
            bus.$on( 'cookie-notice-status', this.toggleCookieIsOpen ); // from cookies.js
            bus.$on( 'splash-screen-status', this.toggleNavigationOverSplash ); // from splash.js

            // used on the languages menu and context menu for products (mobile)
            this.$nextTick( this.bindToOpenLinks );

        },
        beforeDestroy() {
            window.removeEventListener( 'resize', this.onWindowResize );
            window.removeEventListener( 'scroll', this.onWindowScroll );
        },
        methods: {
            toggleMainMenu() {
                this.mainIsOpen = !this.mainIsOpen;
                this.toggleMainFixed();
            },
            toggleMainFixed() {
                let inViewPort = watcher !== null ? watcher.isInViewport : true;
                this.mainIsFixed = !inViewPort && !this.mainIsOpen;

                // used on the languages menu and context menu for products (mobile)
                this.bindToOpenLinks();

            },
            onWindowResize() {
                let vp = getViewPort();
                this.isMobile = vp < mobileViewPort;
            },
            onWindowScroll() {
                this.scroll = getWindowScrollTop();
            },
            toggleCookieIsOpen( status ) {
                this.cookieIsOpen = status;
            },
            toggleNavigationOverSplash( status ) {
                this.splashIsOpen = status;
            },
            bindToOpenLinks() {
                let menus = document.querySelectorAll('.js-open-link');
                if( menus !== null ) {
                    Array.prototype.forEach.call( menus, function(el) {
                        el.onchange = function(e) { window.open( e.target.value , '_top' ) };
                    });
                }
            }

        },
        computed: {
            mainIsOffset() {
                return this.scroll > 200 && !this.mainIsOpen;
            }
        },
        watch: {
            currentArtSet( val, oldVal ) {
                if( this.artSets.length < 0 ) {
                    return;
                }
                if( this.mainIsFixed ) { smoothScroll( 'section.js-vue-art-gallery', 500, 0 ); }
                bus.$emit( 'art-gallery-selected', this.artSets[ val ] );
            },
        }

    });

}

