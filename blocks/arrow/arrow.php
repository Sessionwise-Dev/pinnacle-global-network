<?php

$classes = !empty( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md'; 

$id = !empty( $block['anchor'] ) ? $block['anchor'] : '';

$style = '';

$units = get_field( 'max_width_units' ) ?: 'px';

switch( $units ):

    case 'px':
        $style .= 'max-width:' . ( get_field( 'max_width_px' ) ?: '160' ) . 'px;width: 100%;';
        break;

    case '%':
        $style .= 'max-width:' . get_field( 'max_width_percentage' ) . '%;width: 100%;';
        break;

endswitch;


switch( get_field( 'image_alignment' ) ){

    case 'left':
        $style .= 'margin-right: auto;';
        break;

    case 'right':
        $style .= 'margin-left: auto;';
        break;

    default:
        $style .= 'margin-left: auto; margin-right: auto';
        break;
    
}

echo '<div ' . ( !empty( $id ) ? 'id="' . $id . '" ' : '') . 'class="block-arrow' . $classes . '" style="' . $style . '">';
    if( get_field( 'right_to_left' ) ){
        get_template_part( 'template-parts/svg/pgn-arrow-rtl' );
    }
    else{
        get_template_part( 'template-parts/svg/pgn-arrow' );
    }
echo '</div>';