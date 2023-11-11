import $ from 'jquery';

$('.block-accordion').each(function(){

    $(this).find('.accordion-item').each(function(){

        
        $(this).click(function(){

            if(!$(this).hasClass('active')) {
                $('.accordion-item.active').find('.accordion-content').slideUp();
                $('.accordion-item.active').removeClass('active');

                $(this).toggleClass('active');
                $(this).find('.accordion-content').slideToggle();
            } else {
                $('.accordion-item.active').removeClass('active');
                $(this).find('.accordion-content').slideToggle();
            }
            
        });

    });

});           