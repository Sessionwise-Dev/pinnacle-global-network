import $ from 'jquery';
import mixitup from '../vendor/mixitup.min.js';

var membersContainer = $('.team-members-wrapper');

if(membersContainer.length != 0) { // avoid running script on pages without team block
    var membersMixer = mixitup(membersContainer);

    $('.department-selector').on('change', function(){
        var selectedValue = $(this).val();

        if(selectedValue == 'all') {
            membersMixer.filter(selectedValue);
        } else {
            membersMixer.filter('.'+selectedValue)
        }
        
    });
}
