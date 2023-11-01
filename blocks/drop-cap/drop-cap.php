<?php 

$id = isset( $block['anchor'] ) ? $block['anchor'] : '';
$classes = isset( $block['className'] ) ? ' ' . $block['className'] : ''; 
$spacing = get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md';

$drop_cap = get_field('drop_cap');
$drop_heading = get_field('drop_heading');
$drop_content = get_field('drop_content');


echo '<div class="drop-cap-block' . $classes .''.$spacing.'"' . (!empty($id) ? 'id="'.$id.'"' : '') . '>';
    echo '<h3 class="drop-cap">'.$drop_cap.'</h3>';
    echo '<div class="drop-content">'.
        '<h3 class="drop-cap-cont">'.$drop_heading.'</h3>'.
        '<p>'.$drop_content.'</p>'.
        '</div>';
echo '</div>';