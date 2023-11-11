<?php

$classes = isset( $block['className'] ) ? ' ' . $block['className'] : '';
$columnClass = '';

$id = isset( $block['anchor'] ) ? $block['anchor'] : '';

$blockID = $block['id'];

$display_type = get_field('display_type');
$style = get_field('style');

$testimonial_group = get_field('testimonial_category');
$number_of_testimonials = ( !empty(get_field('number_of_testimonials')) ? get_field('number_of_testimonials') : 6 );

// Grid style
$number_of_columns = get_field('number_of_columns');
$columnClass .= ' gap-' . get_field( 'column_gap' ) ?: 'sm';

// Slide style
$slide_animation = get_field('slide_animation');
$autoplay = get_field('autoplay');
$autoplay_delay = get_field('autoplay_delay');
$mobile_auto_height = get_field('mobile_auto_height');
$controls_display_type = get_field('controls_display_type');

$classes .= ' '.get_field('color_mode');

switch( $controls_display_type ){
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


switch($number_of_columns) {
    case 2: 
        $columnClass .= ' cols-2';
        break;

    case 3: 
        $columnClass .= ' cols-3';
        break;

    case 4: 
        $columnClass .= ' cols-4';
        break;
    
}



$testimonials = get_posts(
    array(
        'post_type' => 'testimonial',
        'numberposts' => $number_of_testimonials,
        'tax_query' => array(
            array(
                'taxonomy' => 'testimonial-category',
                'field' => 'term_id',
                'terms' => $testimonial_group,
            )
        )
    )
);



switch($style) {

    case 'style2':
        $classes .= ' testimonials-style2';
        break;
    case 'style3':
        $classes .= ' testimonials-style3';
        break;
    
    case 'style1':
        $classes .= ' testimonials-style1';
        break;
}

// Style 1
if($style == 'style1') {
    
    echo '<div class="block-testimonials'.$classes.'" data-animation="' . esc_attr( $slide_animation ) . '" data-autoplay="' . esc_attr( $autoplay ) . '" data-autoplay-delay="' . esc_attr( $autoplay_delay ) . '" data-auto-height="' . esc_attr( $mobile_auto_height ) . '">';

        echo '<div class="testimonials'.(($display_type == 'grid') ? ' swiper' : $display_type).'">
            <div class="swiper-wrapper">';

            foreach($testimonials as $testimonial){
                $id = $testimonial->ID;
                
                $name = get_the_title($id);
                
                $position = get_field('position', $id);
                $image = get_the_post_thumbnail($id, 'medium', array( 'class' => 'testimonial-author-image' ));

                

                echo '<div class="testimonial-item swiper-slide">
                        <img src="'.get_template_directory_uri().'/src/images/quote.webp" alt="quote" />';

                        if(get_field('testimonial_type', $id)) {

                            $content = get_field('content', $id);
                            echo (!empty($content) ? '<h4 class="testimonial-content mt-md">'.$content.'</h4>' : '');
                        
                        }

                        echo '<div class="testimonial-author-info mt-lg">'.
                            (has_post_thumbnail($id) ? $image : '').
                            '<div class="testimoial-author-name">'.
                            '<p class="name">'.$name.'</p>'.
                            '<p class="position">'.$position.'</p>'.
                            '</div>'.
                        '</div>';

                echo '</div>';
            }            

            echo '</div>';
        
        echo '</div>';

        
        if( $dots ){
            $dots_alignment = get_field( 'dots_alignment' ) ? ' ' . get_field( 'dots_alignment' ) : ' jc-center';
            $dots_color = get_field( 'dots_color' ) ? ' ' . get_field( 'dots_color' ) : ' light';
            echo '<div class="swiper-pagination' . $dots_alignment . $dots_color . '"></div>';
        }
        

        //Slider Navigation
        if( $arrows ){
            $arrow_color = get_field( 'arrow_icon_color' ) ?: '#FFF';
            echo '<div class="swiper-button-prev slider-arrow" style="color:' . esc_attr( $arrow_color ) . ';"></div>';
            echo '<div class="swiper-button-next slider-arrow" style="color:' . esc_attr( $arrow_color ) . ';"></div>';
        }


    echo '</div>';

}


// Style 2
if($style == 'style2') {

    echo '<div class="block-testimonials'.$classes.'" data-slides-per-view="'.$number_of_columns.'" data-animation="' . esc_attr( $slide_animation ) . '" data-autoplay="' . esc_attr( $autoplay ) . '" data-autoplay-delay="' . esc_attr( $autoplay_delay ) . '" data-auto-height="' . esc_attr( $mobile_auto_height ) . '">';

        echo '<div class="testimonials'.(($display_type == 'slider') ? ' swiper' : '').'">
            <div class="'.(($display_type == 'slider') ? 'swiper-wrapper' : 'd-grid'.$columnClass).'">';

            foreach($testimonials as $testimonial){
                $id = $testimonial->ID;
                
                $name = get_the_title($id);
                
                $position = get_field('position', $id);
                $image = get_the_post_thumbnail($id, 'medium', array( 'class' => 'testimonial-author-image' ));

                

                echo '<div class="testimonial-item swiper-slide">';

                        if(get_field('testimonial_type', $id)) {

                            $content = get_field('content', $id);
                            echo (!empty($content) ? '<div class="testimonial-content mt-md">'.$content.'</div>' : '');
                        
                        } 

                        echo '<div class="testimonial-author-info mt-lg">'.
                            (has_post_thumbnail($id) ? $image : '').
                            '<div class="testimoial-author-name">'.
                            '<h3 class="name">'.$name.'</h3>'.
                            '<p class="position">'.$position.'</p>'.
                            '</div>'.
                        '</div>';

                echo '</div>';
            }            

            echo '</div>';
        
        echo '</div>';

        
        if( $dots && $display_type == 'slider'){
            $dots_alignment = get_field( 'dots_alignment' ) ? ' ' . get_field( 'dots_alignment' ) : ' jc-center';
            $dots_color = get_field( 'dots_color' ) ? ' ' . get_field( 'dots_color' ) : ' light';
            echo '<div class="swiper-pagination' . $dots_alignment . $dots_color . '"></div>';
        }
        

        //Slider Navigation
        if( $arrows && $display_type == 'slider'){
            $arrow_color = get_field( 'arrow_icon_color' ) ?: '#FFF';
            echo '<div class="swiper-button-prev slider-arrow" style="color:' . esc_attr( $arrow_color ) . ';"></div>';
            echo '<div class="swiper-button-next slider-arrow" style="color:' . esc_attr( $arrow_color ) . ';"></div>';
        }


    echo '</div>';
}

// Style 3 
if($style == 'style3') {

    echo '<div class="block-testimonials'.$classes.'" data-slides-per-view="'.$number_of_columns.'" data-animation="' . esc_attr( $slide_animation ) . '" data-autoplay="' . esc_attr( $autoplay ) . '" data-autoplay-delay="' . esc_attr( $autoplay_delay ) . '" data-auto-height="' . esc_attr( $mobile_auto_height ) . '">';

        echo '<div class="testimonials'.(($display_type == 'slider') ? ' swiper' : '').'">
            <div class="'.(($display_type == 'slider') ? 'swiper-wrapper' : 'd-grid'.$columnClass).'">';

            foreach($testimonials as $testimonial){
                $id = $testimonial->ID;
                
                $name = get_the_title($id);
                
                $position = get_field('position', $id);
                $image = get_the_post_thumbnail($id, 'medium', array( 'class' => 'testimonial-author-image' ));

                

                echo '<div class="testimonial-item swiper-slide">';

                        if(get_field('testimonial_type', $id) == 'text') {

                            $content = get_field('content', $id);
                            echo (!empty($content) ? '<div class="testimonial-content mt-md">'.$content.'</div>' : '');
                        
                        } elseif(get_field('testimonial_type', $id) == 'video') {

                            $video = get_field('video', $id);
                            $poster = get_field('video_poster', $id);

                            preg_match('/src="(.+?)"/', $video , $matches);
                            $src = $matches[1];


                            echo '<a href="#" class="custom-modal-trigger lightbox-poster" data-modal="' . $src . '">';
                                echo '<div class="overlay"></div>';
                                echo wp_get_attachment_image( $poster, 'large', 'null', ['class' => 'poster-img'] );
                                echo '<img src="' . get_stylesheet_directory_uri() . '/dist/images/play-white.svg" alt="play-button" class="play-button">';
                            echo '</a>';
                            include( locate_template( 'template-parts/components/lightbox-modal.php' ) );

                        }

                        echo '<div class="testimonial-author-info mt-sm">'.
                            '<div class="testimoial-author-name">'.
                            '<p class="name">'.$name.'</p>'.
                            '<p class="position">'.$position.'</p>'.
                            '</div>'.
                        '</div>';

                echo '</div>';
            }            

            echo '</div>';
        
        echo '</div>';

        
        if( $dots && $display_type == 'slider'){
            $dots_alignment = get_field( 'dots_alignment' ) ? ' ' . get_field( 'dots_alignment' ) : ' jc-center';
            $dots_color = get_field( 'dots_color' ) ? ' ' . get_field( 'dots_color' ) : ' light';
            echo '<div class="swiper-pagination' . $dots_alignment . $dots_color . '"></div>';
        }
        

        //Slider Navigation
        if( $arrows && $display_type == 'slider'){
            $arrow_color = get_field( 'arrow_icon_color' ) ?: '#FFF';
            echo '<div class="swiper-button-prev slider-arrow" style="color:' . esc_attr( $arrow_color ) . ';"></div>';
            echo '<div class="swiper-button-next slider-arrow" style="color:' . esc_attr( $arrow_color ) . ';"></div>';
        }


    echo '</div>';
}