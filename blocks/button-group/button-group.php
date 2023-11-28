<?php

$classes = isset( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'animation_type') ? ' ' . get_field( 'animation_type' ) : '';
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md';
$classes .= get_field( 'button_alignment' ) ? ' align-' . get_field( 'button_alignment' ) : '';
$classes .= get_field( 'button_gap' ) ? ' button-gap-' . get_field( 'button_gap' ) : '';

$id = isset( $block['anchor'] ) ? $block['anchor'] : '';

$template = [['acf/button']];

$allowed_blocks = ['acf/button'];

echo is_admin() ? '<div class="admin-block-label">Button Group</div>' : '';
echo '<InnerBlocks  ' . ( !empty( $id ) ? 'id="' . $id . '" ' : '') . 'class="block-button-group' . $classes . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" templateLock="false"/>';