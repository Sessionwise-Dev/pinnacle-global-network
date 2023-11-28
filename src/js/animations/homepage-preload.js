import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock';
import { gsap } from "gsap";

document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.querySelector('.pgn-home-animation');
    if(wrapper){
        let bgWrap = document.querySelector('.pgn-home-animation-bg');
        let logoWrap = document.querySelector('.pgn-home-animation-logo-wrap');
        let logo = document.querySelector('.pgn-home-animation-logo img');
        let shape = document.querySelector('.pgn-home-animation-logo .overlay');
        wrapper.classList.add('active');
        disableBodyScroll(wrapper);
        let tl = gsap.timeline({
            delay: .75,
            onComplete: () => enableBodyScroll(wrapper)
        });
        tl.to(shape, {
            scaleY: 0,
            duration: .75,
            ease: "power2.out"
        }, 0);
        tl.to(logo, {
            autoAlpha: 1,
            y: 0,
            duration: .5,
            onComplete: () => document.querySelector('body').classList.remove('hide-content')
        }, 0);
        tl.to(bgWrap, {
            y: '-100%',
            ease: 'power2.inOut',
            duration: 1.5, 
        }, '+=.5');
        tl.fromTo('.site-content', {
            y: 250
        }, {
            y: 0,
            duration: 1,
            ease: "power2.inOut"
        }, '<');
        tl.to(logoWrap, {
            autoAlpha: 0,
            duration: .25
        }, "<");
        tl.to(wrapper, {
            autoAlpha: 0,
            duration: 0
        });
    }
    else{
        document.querySelector('body').classList.remove('hide-content');
    }
});