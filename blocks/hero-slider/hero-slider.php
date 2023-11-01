<?php 

    $id = isset( $block['anchor'] ) ? $block['anchor'] : '';
    $classes = isset( $block['className'] ) ? ' ' . $block['className'] : ''; 

    $heading = get_field('heading');

    $template = [['acf/button-group']];
    $allowed_blocks = ['acf/button-group'];



echo '<section class="hero-slider-block'. $classes .'"' . (!empty($id) ? 'id="'.$id.'"' : '') . '>';
     echo '<div class="hero-container">';
        echo '<div class="hero-content-inner">';
            echo $heading ? '<h1 class="hero-heading">'.$heading.'</h1>' : '';
            echo '<InnerBlocks  ' . ( !empty( $id ) ? 'id="' . $id . '" ' : '') . 'class="block-button-group' . $classes . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" templateLock="false"/>';
        echo '</div>';
  
        echo '<div class="hero-slider-inner">';
  
            $slideshow_images = get_field('slideshow_images');

            if( $slideshow_images ): 

                echo '<div class="swiper hero-slider">';
                    echo '<div class="swiper-wrapper">';

                        foreach( $slideshow_images as $image ): 
                            echo '<div class="swiper-slide">';
                                echo '<img src="'. esc_url($image['url']) .'" alt="'. esc_attr($image['alt']) .'" />';
                            echo '</div>';
                        endforeach; 

                    echo '</div>';
                echo '</div>';

            endif; 

        echo '</div>';
    echo '</div>';

echo '</section>';

