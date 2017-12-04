/*jshint esversion: 6 */

export default function fixIeBugs() {
    if( !window.Modernizr.objectfit ) {
        return;
    }

    let elemsToShow = document.querySelectorAll( '.js-hide-if-ie' );
    let elemsToHide = document.querySelectorAll( '.js-show-if-ie' );

    if( elemsToShow !== null ) {
        Array.prototype.forEach.call( elemsToShow, show );
    }

    if( elemsToHide !== null ) {
        Array.prototype.forEach.call( elemsToHide, hide );
    }
}

function show( el ) {
    el.style.display = 'block';
}

function hide( el ) {
    el.style.display = 'none';
}