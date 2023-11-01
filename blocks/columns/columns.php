<?php

$classes = isset( $block['className'] ) ? ' ' . $block['className'] : '';
$spacing = get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md';

$id = isset( $block['anchor'] ) ? $block['anchor'] : '';

$col_count = get_field( 'number_of_columns' );
$display = get_field( 'display_type' ) ?: 'grid';

$classes .= ' d-' . $display;
$classes .= ' gap-' . get_field( 'column_gap' ) ?: 'sm';

switch( get_field( 'vertical_alignment' ) ){
    case 'Center':
        $alignment = 'ai-center';
        break;

    case 'End':
        $alignment = 'ai-end';
        break;

    case 'Stretch':
        $alignment = 'ai-stretch';
        break;

    default:
        $alignment = 'ai-start';
        break;
}

if( $display == 'flex' ){
    $classes .= ' jc-' . get_field( 'justify_content' );
}

$classes .= ' ' . $alignment;

switch( $col_count ){
    case 2:
        $classes .= ' cols-2 ' . get_field( 'two_column_layout' ) . ( get_field( 'reverse_on_mobile' ) ? ' reverse-mobile' : '' );
        break;

    default:
        $classes .= ' cols-' . $col_count;
        break;
}

echo '<div ' . ( !empty( $id ) ? 'id="' . $id . '" ' : '') . 'class="block-columns' . $spacing . '">';

    echo is_admin() ? '<div class="admin-block-label">Columns</div>' : '';

    $index = 1;

    $template = array();

    while( $index <= $col_count ):
        $template[] = [ 'acf/column' ];
        $index++;
    endwhile;

    $allowed_blocks = [
        'acf/column'
    ];

    echo '<InnerBlocks class="block-columns-row' . $classes . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" templateLock="false"/>';

echo '</div>';