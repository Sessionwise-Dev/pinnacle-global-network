<?php

$classes = isset( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md'; 

$id = isset( $block['anchor'] ) ? $block['anchor'] : '';

$number_of_posts = get_field('number_of_posts');
$columns = get_field('columns');
$category = get_field('category');

$classes .= ' d-grid';
$classes .= ' gap-' . get_field( 'column_gap' ) ?: 'sm';

$classes .= ' cols-' . $columns;

$args = array(
    'numberposts' => $number_of_posts,
    'category' => $category,
    'post_status' => 'publish'
);

$posts = get_posts($args);


echo '<div class="blog-posts'.$classes.'" '.( !empty( $id ) ? 'id="' . $id . '" ' : '').'>';

    foreach($posts as $post) {

            $post_id = $post->ID;

            echo '<div class="blog-post">';

                echo '<div class="featured-image-container">';

                    echo has_post_thumbnail($post_id) ? get_the_post_thumbnail( $post_id, 'medium_large' ) : '<img style="background: #bbb;" src="'.get_template_directory_uri().'/src/images/placeholder-image.png">';
                echo '</div>';

                echo '<div class="blog-post-content">';

                    echo '<h3 class="blog-post-title">'.get_the_title($post_id).'</h3>';

                    echo '<div class="blog-post-meta">';
                        echo '<span class="post-date">'.get_the_date('F j, Y', $post_id).'</span>';
                    echo '</div>';

                    echo '<div class="blog-post-excerpt">';
                        echo substr(get_the_excerpt($post_id), 0, 200).' ....';
                    echo '</div>';
                    
                    echo '<a href="'.get_the_permalink($post_id).'" class="read-more theme-button primary">Read More</a>';
                
                echo '</div>';
            
            echo '</div>';
    }

echo '</div>';