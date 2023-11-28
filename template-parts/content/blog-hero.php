<?php
$title = 'Blog';
$subhead = 'Media';
if( is_category() ){
    $cat = get_category( get_query_var( 'cat' ) );
    $title = $cat->name;
    $subhead = 'Category';
}
if( is_search() ){
    $title = get_search_query();
    $subhead = 'Search';
}
if( is_date() ){
    $subhead = 'Archives';
    $title = get_the_date( 'F Y' );
} ?>
<section class="block-fw-text-media-cols-wrap pad-none">
    <div class="block-fw-text-media-cols img-left img-direction-column ai-center mt-none media-col-50">
        <div class="block-fw-media-col">
            <div class="block-image rm-border-top-right mt-none default">
                <div style="margin-left: auto; margin-right: auto">
                    <div class="force-aspect aspect-21x9">
                        <?php echo wp_get_attachment_image( get_field( 'blog_hero_image', 'option' ), 'full' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-fw-content-col-wrap">
            <div class="block-fw-content-col">
                <div class="acf-innerblocks-container">
                    <p class="wp-block-paragraph mt-sm has-sky-blue-2-color has-text-color text-uppercase"><strong><?php echo $subhead; ?></strong></p>
                    <h2 class="wp-block-heading has-text-align-left mt-xs text-capitalize"><?php echo $title; ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>