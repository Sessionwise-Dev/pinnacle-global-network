<?php

$classes = !empty( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md'; 
$classes .= get_field( 'animation_type') ? ' ' . get_field( 'animation_type' ) : '';

$id = !empty( $block['anchor'] ) ? $block['anchor'] : '';

$num = get_field( 'number' );

$color = get_field( 'color' ) ?: '#545555';

if( empty( $num ) || !is_numeric( $num ) ) return;

$increment = is_numeric( $num ) && floor( $num ) != $num ? .1 : 1;

echo '<div ' . ( !empty( $id ) ? 'id="' . $id . '" ' : '') . 'class="block-count-up custom-content-row' . $classes . '" style="color:' . esc_attr( $color ) . '">';
    echo '<span class="count-up" data-end="' . esc_attr( $num ) . '" data-increment="' . esc_attr( $increment ) . '">' . ( is_admin() && !wp_doing_ajax() ? $num : 0 ) . '</span>';
    echo get_field( 'text_after_number' ) ? '<span class="num-text">' . get_field( 'text_after_number' ) . '</span>' : '';
echo '</div>';