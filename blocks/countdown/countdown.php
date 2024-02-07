<?php

$classes = !empty( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md'; 
$classes .= get_field( 'animation_type') ? ' ' . get_field( 'animation_type' ) : '';

$id = !empty( $block['anchor'] ) ? $block['anchor'] : '';

$date_of_event = get_field('date_of_event');
$timer_text = get_field('timer_text');
$text_color = get_field('text_color');


$utc_date_timestamp = new DateTime($date_of_event, new DateTimeZone("UTC")); 
$formatted_utc_date = $utc_date_timestamp->format("F j, Y g:i a");

$background_type = get_field('background_type');

// if solid background
$background_solid = get_field('background_solid');

// if gradient background
$background_gradient_1 = get_field('background_gradient_1');
$background_gradient_2 = get_field('background_gradient_2');

$enable_progress_bar = get_field('enable_progress_bar');
$progress_bar_text = get_field('progress_bar_text');
$progress_bar_percentage = get_field('progress_bar_percentage');
$progress_bar_color = get_field('progress_bar_color');

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

switch ($progress_bar_color) {
    case 'yellow': 
        $progress_bar_color_class = 'bg-yellow';
        break;

    default:
        $progress_bar_color_class = 'bg-blue';
}

?>

<div class="block-countdown-timer" data-target-date="<?= !empty($formatted_utc_date) ? $formatted_utc_date : date('F j, Y g:i a') ?>">
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

<?php if($enable_progress_bar) : ?>
    <div class="block-progress-bar">
        <span class="progress-text"><?= !empty($progress_bar_text) ? $progress_bar_text : 'Time is running out!'; ?></span>
        <span class="progress-text-mobile"><?= !empty($progress_bar_text) ? $progress_bar_text : 'Time is running out!'; ?></span>
        <span class="progress-percentage" style="right: <?= !empty($progress_bar_percentage) ? (100 - $progress_bar_percentage).'%' : '5%'; ?>;"><?= !empty($progress_bar_percentage) ? $progress_bar_percentage.'%' : '0%'; ?></span>
        <progress class="<?= $progress_bar_color_class; ?>" max="100" value="<?= !empty($progress_bar_percentage) ? $progress_bar_percentage : 0 ; ?>"></progress>
    </div>
<?php endif; ?>