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

    var elementHeights = $('.team-member-info').map(function() {
        return $(this).height();
    }).get();
    
    // Math.max takes a variable number of arguments
    // `apply` is equivalent to passing each height as an argument
    var maxHeight = Math.max.apply(null, elementHeights);
    
    // Set each height to the max height
    $('.team-member-info').height(maxHeight);
}