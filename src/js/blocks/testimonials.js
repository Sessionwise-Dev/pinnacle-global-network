import Swiper from '../vendor/swiper-bundle.min.js';
import $ from 'jquery';

document.querySelectorAll('.block-testimonials').forEach(el => {
    const next = el.querySelector('.swiper-button-next');
    const prev = el.querySelector('.swiper-button-prev');
    const dots = el.querySelector('.swiper-pagination');
    const slider = el.querySelector('.swiper');
    const animation = el.dataset.animation;
    const autoplay = el.dataset.autoplay;
    const autoplayDelay = el.dataset.autoplayDelay;
    const mobileAutoHeight = el.dataset.autoHeight == 1 ? true : false;
    const speed = animation == 'none' ? 0 : 300;
    const slidesPerView = (el.dataset.slidesPerView) ? el.dataset.slidesPerView : 1;

    let args = {
        loop: true,
        spaceBetween: 50,
        speed: speed,
        autoHeight: mobileAutoHeight,
        slidesPerView: 1,
        slidesPerGroup: 1,
        breakpoints: {
            768: {
                autoHeight: false,
                slidesPerView: parseInt(slidesPerView),
                slidesPerGroup: parseInt(slidesPerView),
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