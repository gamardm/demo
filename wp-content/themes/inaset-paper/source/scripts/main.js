/*jshint esversion: 6 */

import initNavigation from './navigation';
import initProductCanvas from './product-canvas';
import initProductApplication from './product-applications';
import { initSlider } from './slider';
import { initScrollHorizontal } from './scroll-horizontal';
import initButtonReadMore from './scroll-to';
import initArtGallery from './art-gallery';
import initHomeAnimations from './home';
import initFormsVue from './forms';
import initAnimations from './animations';
import initCookiesNotice from './cookies';
import initSplash from './splash';

// Polygill needed for axios to work with IE11
import Promise from 'es6-promise';
Promise.polyfill();


initNavigation();
initCookiesNotice();
initHomeAnimations();
initProductCanvas();
initProductApplication();
initSlider();
initScrollHorizontal();
initButtonReadMore();
initArtGallery();
initFormsVue();
initAnimations();
initSplash();

import fixIeBugs from './ie-bugs';
fixIeBugs();