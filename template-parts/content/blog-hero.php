<?php
$title = is_post_type_archive( 'podcast' ) ? 'Podcasts' : 'Blog';
$subhead = 'Media';
if( is_category() ){
    $cat = get_category( get_query_var( 'cat' ) );
    $title = $cat->name;
    $subhead = is_post_type_archive( 'podcast' ) ? 'Podcast Category' : 'Category';
}
if( is_search() && !empty( get_search_query() ) ){
    $title = get_search_query();
    $subhead = is_post_type_archive( 'podcast' ) ? 'Podcast Search' : 'Search';
}
if( is_date() ){
    $subhead = is_post_type_archive( 'podcast' ) ? 'Podcast Archives' : 'Archives';
    $title = get_the_date( 'F Y' );
} 

$text = is_post_type_archive( 'podcast' ) ? get_field( 'podcasts_hero_text', 'option' ) : get_field( 'blog_hero_text', 'option' ); ?>

<section class="block-section container-x-pad container-y-pad bg-alice-blue">
   <div class="block-section-content">
    <p class="wp-block-paragraph mt-sm has-sky-blue-2-color has-text-color text-uppercase"><strong><?php echo $subhead; ?></strong></p>
    <h1 class="wp-block-heading has-text-align-left mt-xs text-capitalize"><?php echo $title; ?></h1>
    <?php if( !empty( $text) ): ?>
    <p class="wp-block-paragraph mt-sm is-style-lg"><?php echo $text; ?></p>
    <?php endif; ?>
   </div>
</section>