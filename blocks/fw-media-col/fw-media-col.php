<?php

$id = !empty( $block['anchor'] ) ? $block['anchor'] : '';
$classes = !empty( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'animation_type') ? ' ' . get_field( 'animation_type' ) : '';

$allowed_blocks = [
    'acf/image',
    'acf/video',
    'core/paragraph'
];

$template = [['acf/image']];
    
echo is_admin() ? '<div class="admin-block-label">Media Column</div>' : '';
echo '<InnerBlocks class="block-fw-media-col' . $classes . '" allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="false" />';
