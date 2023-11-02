import $ from 'jquery';
import mixitup from '../vendor/mixitup.min.js';

var membersContainer = $('.team-members-wrapper');

var membersMixer = mixitup(membersContainer);

$('.department-selector').on('change', function(){
    var selectedValue = $(this).val();

    if(selectedValue == 'all') {
        membersMixer.filter(selectedValue);
    } else {
        membersMixer.filter('.'+selectedValue)
    }
    
});


console.log('init');