<?php

$classes = !empty( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md'; 

$id = !empty( $block['anchor'] ) ? $block['anchor'] : '';

$animation = get_field( 'slide_animation' ) ?: 'default';
$autoplay = get_field( 'autoplay' ) ?: 0;
$autoplay_delay = get_field( 'autoplay_delay' ) ? get_field( 'autoplay_delay' ) * 1000 : 7000;
$mobile_auto_height = get_field( 'mobile_auto_height') ?: false;

switch( get_field( 'controls_display_type' ) ){
    case 'dots':
        $dots = true;
        $arrows = false;
        $classes .= ' has-controls-dots';
        break;
    case 'arrows':
        $arrows = true;
        $dots = false;
        $classes .= ' has-controls-arrows';
        break;
    default:
        $arrows = true;
        $dots = true;
        $classes .= ' has-controls-arrows has-controls-dots';
        break;
}

echo '<div ' . ( !empty( $id ) ? 'id="' . $id . '" ' : '') . 'class="block-slider' . $classes . '" data-animation="' . esc_attr( $animation ) . '" data-autoplay="' . esc_attr( $autoplay ) . '" data-autoplay-delay="' . esc_attr( $autoplay_delay ) . '" data-auto-height="' . esc_attr( $mobile_auto_height ) . '">';

    echo is_admin() ? '<div class="admin-block-label">Slider</div>' : '';
        
    $template = [
        ['acf/slide'],
        ['acf/slide']
    ];

    $allowed_blocks = ['acf/slide'];

    echo '<div class="swiper">';

        echo '<InnerBlocks class="swiper-wrapper" template="' . esc_attr( wp_json_encode( $template ) ) . '" allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" templateLock="false"/>';
    
    echo '</div>';

    if( !empty( $dots ) ){
        $dots_alignment = get_field( 'dots_alignment' ) ? ' ' . get_field( 'dots_alignment' ) : ' jc-center';
        $dots_color = get_field( 'dots_color' ) ? ' ' . get_field( 'dots_color' ) : ' light';
        echo '<div class="swiper-pagination' . $dots_alignment . $dots_color . '"></div>';
    }

    //Slider Navigation
    if( !empty( $arrows ) ){
        $arrow_color = get_field( 'arrow_icon_color' ) ?: '#FFF';
        echo '<div class="swiper-button-prev slider-arrow" style="color:' . esc_attr( $arrow_color ) . ';"></div>';
        echo '<div class="swiper-button-next slider-arrow" style="color:' . esc_attr( $arrow_color ) . ';"></div>';
    }

echo '</div>';