import '../vendor/gsap.min.js';
import '../vendor/ScrollTrigger.min.js';
import '../vendor/ScrollToPlugin.min.js';
import $ from 'jquery';

gsap.registerPlugin('ScrollTrigger');
gsap.registerPlugin('ScrollToPlugin');

const scrollBasedAnimations = () => {

    let elementsToFade = document.querySelectorAll('.fade-in, .fade-up, .fade-down, .fade-in-grow');
    let elementsToCount = gsap.utils.toArray('.count-up');
    let elementsToRotate = gsap.utils.toArray('.rotation-animation');

    let mm = gsap.matchMedia();

    //Fade animations as elements enter viewport
    elementsToFade.forEach(el => {
        let y = 0;
        let x = 0;
        let scale = 1;
        let delay = 0;
        y = el.classList.contains('fade-up') ? 50 : y;
        y = el.classList.contains('fade-down') ? -50 : y;
        scale = el.classList.contains('fade-in-grow') ? .9 : scale;
        delay = el.dataset.delay ? el.dataset.delay : 0;
        gsap.from(el, {
            y: y,
            x: x,
            scale: scale,
            autoAlpha: 0,
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
            },
            duration: .625,
            ease: 'power2.out',
            delay: delay
        });
    });

    //Add box shadow to header on scroll
    if(document.querySelector('.header-subnav') && window.innerWidth > 1024){
        $('.site-header').addClass('has-shadow');
    }
    else{
        ScrollTrigger.create({
            trigger: 'body',
            start: '50px top',
            end: 'bottom top',
            onEnter: self => $('.site-header').addClass('has-shadow'),
            onLeaveBack: self => $('.site-header').removeClass('has-shadow')
        });
    }
   
    //Count-up block animation
    gsap.registerEffect({
        name:"counter",
        extendTimeline:true,
        defaults:{
            end: 0,
            duration: 1.25,
            increment: 1
        },
        effect: function(targets, config){
            var tl = gsap.timeline();
            var num = targets[0].innerText.replace(/\,/g,'');
            targets[0].innerText = num;
            return gsap.to(targets, {
                duration:config.duration, 
                scrollTrigger: {
                    trigger: targets,
                    start: "top 85%",
                    once: true
                },
                innerText:config.end, 
                modifiers:{
                    innerText:function(innerText){
                        return  gsap.utils.snap(config.increment, innerText).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                },
                ease: 'linear'
            });
        }
    });

    elementsToCount.forEach(function(el){
        var end = el.getAttribute('data-end');
        var increment = el.getAttribute('data-increment');
        gsap.effects.counter(el, {end: end, increment: increment});
    });

    elementsToRotate.forEach(function(el){
        gsap.to(el,{
            duration: 25,
            rotate: 360,
            repeat: -1,
            ease: 'linear'
        });
    });
}

addEventListener('DOMContentLoaded', scrollBasedAnimations);

// Detect if a link's href goes to the current page
function getSamePageAnchor(link) {
    if (
        link.protocol !== window.location.protocol ||
        link.host !== window.location.host ||
        link.pathname !== window.location.pathname ||
        link.search !== window.location.search
    ) {
        return false;
    }
    return link.hash;
}

// Scroll to a given hash, preventing the event given if there is one
function scrollToHash(hash, e) {
    const elem = hash ? document.querySelector(hash) : false;
    if (elem) {
        if (e) e.preventDefault();
        let offset = $('.site-header').outerHeight();
        if (document.getElementById('wpadminbar')) {
            offset += $('#wpadminbar').outerHeight();
        }
        gsap.to(window, {
            duration: .5,
            scrollTo: {
                y: elem,
                offsetY: offset
            }
        });
        history.pushState(null, null, hash);
    }
}

// If a link's href is within the current page, scroll to it instead
document.querySelectorAll('a[href]').forEach(a => {
    a.addEventListener('click', e => {
        scrollToHash(getSamePageAnchor(a), e);
    });
});

// Scroll to the element in the URL's hash on load
scrollToHash(window.location.hash);