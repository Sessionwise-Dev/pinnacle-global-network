import Swiper from '../vendor/swiper-bundle.min.js';

var swiper = new Swiper('.hero-slider', {
    direction: 'horizontal',
    loop: true,
    centeredSlides: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    effect: "creative",
    creativeEffect: {
        prev: {        
            translate: ["-20%", 0, -1],     
        },     
        next: {         
            translate: ["100%", 0, 0],      
        }, 
    },
})