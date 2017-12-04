/*jshint esversion: 6 */

import { smoothScroll } from './helpers';

export default function initButtonReadMore() {
    let elements = document.querySelectorAll('a.js-scroll-down');
    Array.prototype.forEach.call( elements, function( el, i ){
        let target = el.getAttribute('data-scroll-to') || 'section:first-of-type';
        let offset = el.getAttribute('data-scroll-offset') || -1;
        el.onclick = function() {
            smoothScroll( target, 1000, offset );
            return false;
        };
    });
}