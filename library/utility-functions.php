<?php

/**
 * Return html for a button from an ACF link array
 *
 * @param array $link - ACF link array
 * @param array $classes - classes to be added to the button before return
 * @return string $button - html for button
 * @since 1.0.0
 */

 function _themename_acf_button( $link, $classes = array( 'theme-button' ), $id = '', $icon = false ){

    //Immediately return if this is not a link array
    if( empty( $link ) || ( is_array( $link ) && !$link['url'] ) ){
        return;
    }

    else{
        if( is_array($classes ) ){
            $class = implode( ' ', $classes ); 
        }

        $button_text = esc_attr( $link['title'] );
        if( !empty( $icon ) ){
            $button_text .= '<i class="fa-light fa-long-arrow-right"></i>';
        }

        $target = $link['target'] ? ' target="' . $link['target'] . '"' : '';
		$button = '<a  ' . ( !empty( $id ) ? 'id="' . $id . '" ' : '') . 'href="' . esc_url( $link['url'] ) . '" class="' . $class . '"' . $target . '">' . $button_text . '</a>';
        return $button; 
    }
}

/**
 * Gets the primary category set by Yoast SEO.
 * @param int  - post ID
 * @return array The category name, slug, and URL.
 */
function _themename_get_primary_parent_category( $post = null ) {
    
	if( empty( $post ) ) $post = get_the_ID();

	// SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
	$category = get_the_category( $post );

	$primary_category = array();
	// If post has a category assigned.
	if( !empty( $category ) ){
		$category_display = '';
		$category_slug = '';
		$category_link = '';
		if( class_exists('WPSEO_Primary_Term') ){
            // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
			$wpseo_primary_term = new WPSEO_Primary_Term( 'category', $post );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term = get_term( $wpseo_primary_term );
			if( is_wp_error( $term ) ){
				// Default to first category (not Yoast) if an error is returned
                $category_id = $category[0]->term_id;
				$category_name = $category[0]->name;
				$category_slug = $category[0]->slug;
				$category_link = get_category_link( $category[0]->term_id );
			} else {
                // Yoast Primary category
                $category_id = $term->term_id;
				$category_name = $term->name;
				$category_slug = $term->slug;
				$category_link = get_category_link( $term->term_id );
			}
		}
		else {
			// Default, display the first category in WP's list of assigned categories
            $category_id = $category[0]->term_id;
			$category_name = $category[0]->name;
			$category_slug = $category[0]->slug;
			$category_link = get_category_link( $category[0]->term_id );
		}
        $primary_category['id'] = $category_id;
		$primary_category['link'] = $category_link;
		$primary_category['slug'] = $category_slug;
		$primary_category['name'] = $category_name;
	}
	return $primary_category;
}

// Numbered pagination
function _themename_numbered_pagination( $custom_query ) {

    if( empty( $custom_query ) ) return;

	$total_pages = $custom_query->max_num_pages;
	$big = 999999999; // need an unlikely integer

	if ($total_pages > 1){
		$current_page = max(1, $custom_query->query_vars['paged']);

		echo paginate_links(array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'prev_next' => false,
			'current' => $current_page,
			'total' => $total_pages,
			'mid_size' => 2,
			'end_size' => 1
		));
	}
}