<?php

$id = isset( $block['anchor'] ) ? $block['anchor'] : '';
$classes = ['theme-button'];
$classes[] = get_field( 'button_style' ) ?: '';
$classes[] = get_field( 'button_size' ) ?: '';
$classes[] = get_field( 'full_width' ) ? 'fw-button' : '';
$icon = get_field( 'arrow_icon' );
$btn = get_field( 'button' );


$btn_subtext = get_field( 'button_sub-text' ) ?: '';
$classes[] = get_field( 'sub-text' ) ? 'with-subtext' : '';


echo is_admin() ? '<div class="admin-block-label">Button</div>' : '';

$btn = get_field( 'button' );

echo pgn_acf_button( $btn, $classes, $id, $icon, $btn_subtext );