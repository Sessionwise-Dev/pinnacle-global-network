<?php

$classes = isset( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md'; 
$classes .= get_field( 'animation_type') ? ' ' . get_field( 'animation_type' ) : '';

$id = isset( $block['anchor'] ) ? $block['anchor'] : '';

$content = get_field( 'content' );

echo '<div ' . ( !empty( $id ) ? 'id="' . $id . '" ' : '') . 'class="block-wysiwyg' . $classes . '">';
    echo get_field( 'content' );
echo '</div>';