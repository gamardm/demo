/*jshint esversion: 6 */

import { getViewPort } from './helpers';

export default function initHomeAnimations() {
    let blockHome = document.querySelector( '.js-block-home' );
    if( blockHome === null ) {
        return;
    }

    let heading = blockHome.querySelector( '.js-home-heading > em' );
    let headingDefault = heading.textContent;

    let background = blockHome.querySelector( '.js-home-bg-image' );
    let bgPosterSrc = background.getAttribute('poster');
    let bgVideoSrc = background.getAttribute('src');

    let images = [];

    let elements = blockHome.querySelectorAll('a.js-home-product');

    Array.prototype.forEach.call( elements, function( el, i ){

        let bgImage = el.getAttribute('data-bgimage');
        let bgVideo = el.getAttribute('data-bgvideo');
        let keyword = el.getAttribute('data-keyword');

        images.push({ image: bgImage, video: bgVideo });

        el.onmouseover = function() {
            heading.textContent = keyword;
            background.poster = bgImage;
            background.src = '';

        };
        el.onmouseleave = function() {
            heading.textContent = headingDefault;
            background.src = bgVideoSrc;
            background.poster = bgPosterSrc;
        };
    });

    window.onload = function() {

        // Do not preload images on mobile and tablet
        if( getViewPort() < 1023 ) {
            return;
        }

        let arrLength = images.length;

        // preload
        for( let i = 0; i < arrLength; i++ ) {
            let image = new Image();
            image.src = images[i].image;
        }
    };
}