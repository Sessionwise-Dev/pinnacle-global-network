import Swiper from '../vendor/swiper-bundle.min.js';
import $ from 'jquery';

document.querySelectorAll('.block-slider').forEach(el => {
    const next = el.querySelector('.swiper-button-next');
    const prev = el.querySelector('.swiper-button-prev');
    const dots = el.querySelector('.swiper-pagination');
    const slider = el.querySelector('.swiper');
    const animation = el.dataset.animation;
    const autoplay = el.dataset.autoplay;
    const autoplayDelay = el.dataset.autoplayDelay;
    const mobileAutoHeight = el.dataset.autoHeight == 1 ? true : false;
    const speed = animation == 'none' ? 0 : 300;
    let args = {
        loop: true,
        spaceBetween: 15,
        speed: speed,
        autoHeight: mobileAutoHeight,
        breakpoints: {
            768: {
                autoHeight: false
            }
        },
        ...(dots && {
            pagination: {
                el: dots,
                clickable: true
            }
        }),
        ...(next && {
            navigation: {
                nextEl: next,
                prevEl: prev
            }
        }),
        ...(autoplay == 1 && {
            autoplay: {
                delay: autoplayDelay,
                pauseOnMouseEnter: true
            }
        }),
        ...(animation == 'fade' && {
            effect: 'fade',
            fadeEffect: { crossFade: true }
        }),
    };

    const swiper = new Swiper(slider, args);
});