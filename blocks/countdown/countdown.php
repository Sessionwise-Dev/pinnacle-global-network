<?php

$classes = !empty( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md'; 
$classes .= get_field( 'animation_type') ? ' ' . get_field( 'animation_type' ) : '';

$id = !empty( $block['anchor'] ) ? ' id="' . $block['anchor'] . '"' : '';

//Do not display if no date is set
$date_of_event = get_field('date_of_event');
if( empty( $date_of_event ) ){
    echo is_admin() ? '<p class="block-admin-warning">A date must be selected for this block to display correctly.</p>' : ''; 
    return;
}

$timer_text = get_field('timer_text');
$text_color = get_field('text_color');


$utc_date_timestamp = new DateTime($date_of_event, new DateTimeZone("UTC")); 
$formatted_utc_date = $utc_date_timestamp->format("F j, Y g:i a");

$background_type = get_field('background_type');

// if solid background
$background_solid = get_field('background_solid') ?: '#07a5db';

// if gradient background
$background_gradient_1 = get_field('background_gradient_1') ?: '#07a5db';
$background_gradient_2 = get_field('background_gradient_2') ?: '#07a5db';

switch ($background_type) {
    case 'solid': 
        $block_background = 'background: '. $background_solid .';';
        break;
    
    case 'gradient' : 
        $block_background = 'background: linear-gradient(90deg, '.$background_gradient_1.', '.$background_gradient_2.');';
        break;

    default :
        $block_background = 'background: linear-gradient(90deg, #404eaa, #fb2c59);';
}

?>
<div class="block-countdown-timer<?= $classes; ?>" data-target-date="<?= $formatted_utc_date; ?>"<?= $id; ?>>
    <section style="<?= $block_background; ?>" class="pgn-countdown-container container-text-light">
        <h3 style="color: <?=  $text_color; ?>;"><?= !empty($timer_text) ? $timer_text : 'Event starts in...'; ?></h3>
        <ul class="pgn-timer-tiles" style="color: <?=  $text_color; ?>;">
            <li><span class="days-tile">00</span>Days</li>
            <li><span class="hours-tile">00</span>Hours</li>
            <li><span class="minutes-tile">00</span>Minutes</li>
            <li><span class="seconds-tile">00</span>Seconds</li>
        </ul>
    </section>
</div>