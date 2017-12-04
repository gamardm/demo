/*jshint esversion: 6 */

import scrollMonitor from 'scrollmonitor';

export default function initAnimations() {
    let elements = document.querySelectorAll('[data-anim]');
    Array.prototype.forEach.call( elements, makeWatcher );
}


function makeWatcher( element ) {
    let watcher = scrollMonitor.create( element );
    watcher.visibilityChange( addClass );
    addClass.call( watcher );
}


function addClass() {
    let animClass = this.watchItem.getAttribute('data-anim');
    this.watchItem.style.opacity = 0;
    if (!this.isInViewport) {
        this.watchItem.classList.remove( animClass );
    } else {
        this.watchItem.classList.add( animClass );
    }
}
