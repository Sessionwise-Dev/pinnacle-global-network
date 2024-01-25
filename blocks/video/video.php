<?php

$classes = isset( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md'; 
$classes .= get_field( 'animation_type') ? ' ' . get_field( 'animation_type' ) : '';

$id = isset( $block['anchor'] ) ? $block['anchor'] : '';

$video = get_field( 'video' );
$type = get_field( 'video_type' );
$poster = get_field( 'poster_image' );

if( get_field( 'video_host' ) == 'file' ){
    $src = wp_get_attachment_url( get_field( 'video_file' ) );
    $meta = wp_get_attachment_metadata( get_field( 'video_file' ) );
    $video = '<video controls poster="' . ( wp_get_attachment_image_url( $poster, 'large' ) ?: '' ) . '" onclick="console.log(this.paused); this.paused ? this.play() : this.pause(); arguments[0].preventDefault();">';
    $video .= '<source src="' . $src . '" type="video/' . $meta['fileformat'] . '">';
    $video .= '</video>';
}

else{
    preg_match('/src="(.+?)"/', $video , $matches);
    $src = $matches[1];
}

echo '<div ' . ( !empty( $id ) ? 'id="' . $id . '" ' : '') . 'class="block-video' . $classes . '">';

    if( $type == 'lightbox' ){
        $poster = get_field( 'poster_image' );
        echo '<a href="#" class="custom-modal-trigger lightbox-poster" data-modal="' . $src . '">';
            echo '<div class="overlay"></div>';
            echo wp_get_attachment_image( $poster, 'full', 'null', ['class' => 'poster-img'] );
            echo '<img src="' . get_stylesheet_directory_uri() . '/dist/images/play-white.svg" alt="play-button" class="play-button">';
        echo '</a>';
        include( locate_template( 'template-parts/components/lightbox-modal.php' ) );
    }

    else{
        echo '<div class="block-video-embed">';
            echo $video;
        echo '</div>';
    }

    echo get_field( 'caption' ) ? '<p class="media-caption ' . get_field( 'caption_style' ) . '">' . get_field( 'caption' ) . '</p>' : '';

echo '</div>';