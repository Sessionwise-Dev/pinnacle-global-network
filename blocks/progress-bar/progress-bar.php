<?php
$classes = !empty( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md'; 
$classes .= get_field( 'animation_type') ? ' ' . get_field( 'animation_type' ) : '';

$id = !empty( $block['anchor'] ) ? ' id="' . $block['anchor'] . '"' : '';

$progress_bar_text = get_field('progress_bar_text');
$progress_bar_percentage = get_field('progress_bar_percentage');
$progress_bar_color = get_field('progress_bar_color');

switch ($progress_bar_color) {
    case 'yellow': 
        $progress_bar_color_class = 'bg-yellow';
        break;

    default:
        $progress_bar_color_class = 'bg-blue';
} ?>

<div class="block-progress-bar<?= $classes; ?>"<?= $id; ?>>
    <span class="progress-text"><?= !empty($progress_bar_text) ? $progress_bar_text : 'Time is running out!'; ?></span>
    <span class="progress-text-mobile"><?= !empty($progress_bar_text) ? $progress_bar_text : 'Time is running out!'; ?></span>
    <span class="progress-percentage" style="right: <?= !empty($progress_bar_percentage) ? (100 - $progress_bar_percentage).'%' : '5%'; ?>;"><?= !empty($progress_bar_percentage) ? $progress_bar_percentage.'%' : '0%'; ?></span>
    <progress class="<?= $progress_bar_color_class; ?>" max="100" value="<?= !empty($progress_bar_percentage) ? $progress_bar_percentage : 0 ; ?>"></progress>
</div>