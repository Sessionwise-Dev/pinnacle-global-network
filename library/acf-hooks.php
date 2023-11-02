<?php

$parent = acf_add_options_page(
    array(
        'page_title'  => __( 'Theme Settings' ),
        'menu_title'  => __( 'Theme Settings' ),
        'menu_slug'   => 'theme-options',
        'capability'  => 'edit_posts',
    )
);
// acf_add_options_sub_page(
//     array(
//         'page_title'  => __( 'Global Settings' ),
//         'menu_title'  => __( 'Global Settings' ),
//         'menu_slug'   => 'theme-global-settings',
//         'parent_slug' => $parent['menu_slug'] 
//     )
// );
acf_add_options_sub_page(
    array(
        'page_title'  => __( 'Header Settings' ),
        'menu_title'  => __( 'Header Settings' ),
        'menu_slug'   => 'theme-header-settings',
        'parent_slug' => $parent['menu_slug'] 
    )
);
acf_add_options_sub_page(
    array(
        'page_title'  => __( 'Footer Settings' ),
        'menu_title'  => __( 'Footer Settings' ),
        'menu_slug'   => 'theme-footer-settings',
        'parent_slug' => $parent['menu_slug'] 
    )
);

//Load default values so blocks don't appear empty
add_filter('acf/load_value/key=field_62d600ad7bc9a',  '_pinnacle_load_default_video', 10, 3);
function _pinnacle_load_default_video($value, $post_id, $field) {
    if( !isset( $value ) ) $value = 'https://www.youtube.com/watch?v=xcJtL7QggTI';
    return $value;
}

add_filter('acf/load_value/key=field_6519e3bfa3237',  '_pinnacle_load_default_button', 10, 3);
function _pinnacle_load_default_button($value, $post_id, $field) {
    if( !isset( $value ) ){
        $link = [
            'url' => '#',
            'title' => 'Button',
            'target' => ''
        ];
        $value = $link;
    }
    return $value;
}

//Color picker, custom palette
add_action( 'acf/input/admin_footer', '_pinnacle_custom_color_picker_palette' );
function _pinnacle_custom_color_picker_palette(){ ?>
<script type="text/javascript">
    (function($) {
        acf.add_filter('color_picker_args', function( args, $field ){
            args.palettes = ['#FFFFFF', '#fcfbf8', '#f7e4d6', '#07a5db', '#7ed4f1', '#757575', '#353434', '#031122', '#070504'];
            return args;
        });
    })(jQuery);
//</script><?php 
}