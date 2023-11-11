<?php

$image_gallery_count = 1;

add_action( 'init', '_pinnacle_acf_init_block_types' );

function _pinnacle_acf_init_block_types(){
    register_block_type( get_template_directory() . '/blocks/accordion/block.json' );
    register_block_type( get_template_directory() . '/blocks/button/block.json' );
    register_block_type( get_template_directory() . '/blocks/button-group/block.json' );
    register_block_type( get_template_directory() . '/blocks/column/block.json' );
    register_block_type( get_template_directory() . '/blocks/columns/block.json' );
    register_block_type( get_template_directory() . '/blocks/count-up/block.json' );
    register_block_type( get_template_directory() . '/blocks/divider/block.json' );
    register_block_type( get_template_directory() . '/blocks/drop-cap/block.json' );
    register_block_type( get_template_directory() . '/blocks/fw-content-col/block.json' );
    register_block_type( get_template_directory() . '/blocks/fw-media-col/block.json' );
    register_block_type( get_template_directory() . '/blocks/fw-text-media-cols/block.json' );
    register_block_type( get_template_directory() . '/blocks/hero-slider/block.json' );
    register_block_type( get_template_directory() . '/blocks/image/block.json' );
    register_block_type( get_template_directory() . '/blocks/image-gallery/block.json' );
    register_block_type( get_template_directory() . '/blocks/posts-grid/block.json' );
    register_block_type( get_template_directory() . '/blocks/section/block.json' );
    register_block_type( get_template_directory() . '/blocks/slide/block.json' );
    register_block_type( get_template_directory() . '/blocks/slider/block.json' );
    register_block_type( get_template_directory() . '/blocks/spacer/block.json' );
    register_block_type( get_template_directory() . '/blocks/team-members/block.json' );
    register_block_type( get_template_directory() . '/blocks/testimonials/block.json' );
    register_block_type( get_template_directory() . '/blocks/video/block.json' );
    register_block_type( get_template_directory() . '/blocks/wrapper/block.json' );
    register_block_type( get_template_directory() . '/blocks/wysiwyg/block.json' );
}

//Remove most of core blocks and define allowed block types
add_filter( 'allowed_block_types_all', '_pinnacle_allowed_block_types' );
 
function _pinnacle_allowed_block_types( $allowed_blocks ) {
	return apply_filters( '_pinnacle_allowed_block_types', [
        'acf/accordion',
        'acf/button',
        'acf/button-group',
        'acf/column',
        'acf/columns',
        'acf/count-up',
        'acf/divider',
        'acf/drop-cap',
        'acf/fw-content-col',
        'acf/fw-media-col',
        'acf/fw-text-media-cols',
        'acf/hero-slider',
        'acf/image',
        'acf/image-gallery',
        'acf/posts-grid',
        'acf/section',
        'acf/slide',
        'acf/slider',
        'acf/spacer',
        'acf/team-members',
        'acf/testimonials',
        'acf/video',
        'acf/wrapper',
        'acf/wysiwyg',
        'core/list',
		'core/list-item',
        'core/heading',
        'core/paragraph',
        'gravityforms/form'
	]);
}

//Enqueue stylesheet for proper preview display of blocks in the editor
add_action( 'enqueue_block_editor_assets', function(){
    wp_enqueue_style('blocks-admin-style-min', get_template_directory_uri() . '/dist/css/blocks-admin.css', array(), filemtime( get_template_directory() . '/dist/css/blocks-admin.css'), false );
    wp_enqueue_script('blocks-admin-scripts-min', get_template_directory_uri() . '/dist/js/blocks-admin.js', array( 'wp-editor' ), filemtime( get_template_directory() . '/dist/js/blocks-admin.js'), false );
    $translation_array = array( 'templateURL' => get_stylesheet_directory_uri() );
	wp_localize_script( 'blocks-admin-scripts-min', 'theme', $translation_array );
});

//Add fonts to block editor
add_action( 'admin_head', function(){ ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:opsz,wght@6..96,400;6..96,500;6..96,600;6..96,700;6..96,800&family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
<?php });

//Add wrappers around default blocks
add_filter( 'render_block', '_pinnacle_block_wrapper', 10, 2 );
function _pinnacle_block_wrapper( $block_content, $block ) {
    if ( $block['blockName'] === 'gravityforms/form' ) {
        $content = '<div class="custom-content-row theme-form-wrap">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    } 

    return $block_content;
}

//Add styles to core blocks
add_action( 'init', '_pinnacle_core_block_styles' );
function _pinnacle_core_block_styles(){
    //Custom Body Font Sizes
    register_block_style( 'core/paragraph', [
        'name' => 'xl',
        'label' => __( 'XL', '_pinnacle' )
    ] );
    register_block_style( 'core/paragraph', [
        'name' => 'lg',
        'label' => __( 'LG', '_pinnacle' )
    ] );
    register_block_style( 'core/paragraph', [
        'name' => 'md',
        'label' => __( 'MD', '_pinnacle' )
    ] );
    register_block_style( 'core/paragraph', [
        'name' => 'sm',
        'label' => __( 'SM', '_pinnacle' )
    ] );
    register_block_style( 'core/paragraph', [
        'name' => 'xs',
        'label' => __( 'XS', '_pinnacle' )
    ] );
    register_block_style( 'core/list', [
        'name' => 'xl',
        'label' => __( 'XL', '_pinnacle' )
    ] );
    register_block_style( 'core/list', [
        'name' => 'lg',
        'label' => __( 'LG', '_pinnacle' )
    ] );
    register_block_style( 'core/list', [
        'name' => 'md',
        'label' => __( 'MD', '_pinnacle' )
    ] );
    register_block_style( 'core/list', [
        'name' => 'sm',
        'label' => __( 'SM', '_pinnacle' )
    ] );
    register_block_style( 'core/list', [
        'name' => 'xs',
        'label' => __( 'XS', '_pinnacle' )
    ] );
}