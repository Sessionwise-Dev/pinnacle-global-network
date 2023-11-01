<?php

$id = !empty( $block['anchor'] ) ? $block['anchor'] : '';
$classes = !empty( $block['className'] ) ? ' ' . $block['className'] : ''; 
$bg = !empty( $context['acf/fields']['background_color'] ) ? $context['acf/fields']['background_color'] : 'transparent';

$template = [
    array( 'core/heading', array(
        'placeholder' => 'Enter Heading Here',
        'level' => 2,
    )),
    array( 'core/paragraph', array(
        'placeholder' => 'Enter paragraph content here...',
    )),
];

echo is_admin() ? '<div class="admin-block-label">Content Column</div>' : '';
echo '<div class="block-fw-content-col' . $classes . '" style="background-color:' . $bg . ';">';
    echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="false" />';
echo '</div>';