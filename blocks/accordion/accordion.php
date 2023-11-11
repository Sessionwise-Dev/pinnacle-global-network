<?php

$id = isset( $block['anchor'] ) ? $block['anchor'] : '';
$classes = ['theme-button'];
$classes[] = get_field( 'button_style' ) ?: '';
$classes[] = get_field( 'button_size' ) ?: '';
$classes[] = get_field( 'full_width' ) ? 'fw-button' : '';
$icon = get_field( 'arrow_icon' );
$btn = get_field( 'button' );

echo is_admin() ? '<div class="admin-block-label">Button</div>' : '';

$btn = get_field( 'button' );

echo _pinnacle_acf_button( $btn, $classes, $id, $icon );