/*jshint esversion: 6 */
import Vue from 'vue';

const grammagesApp = window.INASET_PRINTSELCT || {};

export default function initProductApplication() {
    "use strict";

    if ( document.querySelector('.js-vue-print-selector') === null ) {
        return;
    }

    let vm = new Vue({
        el:'.js-vue-print-selector',
        data: {
            grammages: grammagesApp.grammages,
            apps: grammagesApp.apps,
            active: 0
        },
        computed: {
            activeTitle() {
                return this.apps[ this.active ].title;
            },
            activeDescription() {
                return this.apps[ this.active ].description;
            },
            activeGrammages() {
                let active = this.apps[ this.active ].grammages.split(',');
                return this.grammages.map( (g) => {
                    let disabled = true;
                    if( active.indexOf(g) >= 0 ) {
                        disabled = false;
                    }
                    return { 'label': g, 'disabled': disabled };
                });
            }
        }

    });


}




