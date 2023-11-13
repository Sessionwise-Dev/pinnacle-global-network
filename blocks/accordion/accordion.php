<?php

$id = isset( $block['anchor'] ) ? $block['anchor'] : '';

$accordion_items = get_field('accordion_items');


echo '<div class="block-accordion">';
    foreach($accordion_items as $accordion) {
        echo '<div class="accordion-item">'.
            '<h3 class="accordion-title">'.$accordion->post_title.'<i class="fa-solid fa-angle-right"></i></h3>'.
            '<div class="accordion-content">'.get_field('accordion_content', $accordion->ID).'</div>'.
        '</div>';
    }
echo '</div>';