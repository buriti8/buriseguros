import { tns } from 'tiny-slider/src/tiny-slider';
import { CountUp } from 'countup.js';
import { WOW } from 'wowjs';

require('isotope-layout');
require('glightbox');
require('imagesloaded');

(function () {

    "use strict";

    //===== Prealoder

    window.onload = function () {
        window.setTimeout(fadeout, 200);
    }

    function fadeout() {
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    }

    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)
    }

    let backtotop = select('.scroll-top')
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active')
            } else {
                backtotop.classList.remove('active')
            }
        }
        window.addEventListener('load', toggleBacktotop)
        onscroll(document, toggleBacktotop)
    }

    /*=====================================
    Sticky
    ======================================= */
    window.onscroll = function () {
        var header_navbar = document.querySelector(".navbar-area");
        var sticky = header_navbar.offsetTop;

        if (window.pageYOffset > sticky) {
            header_navbar.classList.add("sticky");
        } else {
            header_navbar.classList.remove("sticky");
        }
    };

    //===== navbar-toggler
    let navbarToggler = document.querySelector(".navbar-toggler");
    navbarToggler.addEventListener('click', function () {
        navbarToggler.classList.toggle("active");
    })


    //======== tiny slider
    tns({
        container: '.client-logo-carousel',
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 15,
        nav: false,
        controls: false,
        responsive: {
            0: {
                items: 1,
            },
            540: {
                items: 2,
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            }
        }
    });


    //WOW Scroll Spy
    var wow = new WOW({
        //disabled for mobile
        mobile: false,
        live: false
    });
    wow.init();

    //====== counter up 
    var cu = new CountUp({
        start: 0,
        duration: 2000,
        intvalues: true,
        interval: 100,
    });
    cu.start();


})();

Math.easeInOutQuad = function (t, b, c, d) {

    t /= d / 2;
    if (t < 1) return c / 2 * t * t + b;
    t--;
    return -c / 2 * (t * (t - 2) - 1) + b;
};
