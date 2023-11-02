import $ from 'jquery';

$('.filter').click(function () {
    $(this).attr('tabindex', 1).focus();
    $(this).toggleClass('active');
    $(this).find('.dropdown-menu').slideToggle(300);
});
$('.filter').focusout(function () {
    $(this).removeClass('active');
    $(this).find('.dropdown-menu').slideUp(300);
});
$('.filter .dropdown-menu li').click(function () {
    $(this).parents('.filter').find('span').text($(this).text());
    $(this).parents('.filter').find('input').attr('value', $(this).attr('value')).trigger('change');
});
