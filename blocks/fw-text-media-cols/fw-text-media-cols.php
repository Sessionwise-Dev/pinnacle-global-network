<?php
$id = !empty( $block['anchor'] ) ? $block['anchor'] : '';
$block_class = isset( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes = '';
$classes .= get_field( 'image_position' ) ? ' ' . get_field( 'image_position' ) : ' img-left';
$classes .= get_field( 'image_direction' ) ? ' ' . get_field( 'image_direction' ) : '';
$classes .= get_field( 'overlapping_content' ) ? ' overlapping-content': '';
$classes .= get_field( 'vertical_content_alignment' ) ? ' ' . get_field( 'vertical_content_alignment' ) : '';
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md';
$classes .= get_field( 'media_column_width' ) ? ' ' . get_field( 'media_column_width' ) : '';
$section_classes = get_field( 'section_vertical_padding' ) ? ' ' . get_field( 'section_vertical_padding' ) : '';


echo is_admin() ? '<div class="admin-block-label">Full Width Text + Media</div>' : '';
$template = [['acf/fw-media-col'], ['acf/fw-content-col']];
$allowed_blocks = ['acf/fw-media-col', 'acf/fw-content-col'];
echo '<section class="block-fw-text-media-cols-wrap' . $section_classes . ''. $block_class .'" style="background-color:' . ( get_field( 'background_color' ) ?: '#FFFFFF;' ) . ';">';
echo '<InnerBlocks ' . ( isset( $id ) ? 'id="' . $id . '" ' : '') . 'class="block-fw-text-media-cols' . $classes . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" templateLock="false" />';
echo '</section>';