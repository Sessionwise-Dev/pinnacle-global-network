<?php
$args = [
    'posts_per_page' => 5,
    'post_status' => 'publish',
    'post_type' => 'podcast',
]; 
$recent_podcasts = get_posts( $args ); ?>
<div class="blog-sidebar">
    <h2 class="wp-block-heading mt-none">Search Podcasts</h2>
    <?php get_template_part( 'template-parts/components/podcast-searchform' ); ?>
    <section class="widget_block">
        <h2 class="wp-block-heading">Recent Podcasts</h2>
        <ul class="wp-block-latest-posts wp-block-latest-posts__list">
        <?php foreach( $recent_podcasts as $p ): ?>
            <li><a href="<?php echo get_the_permalink( $p ); ?>"><?php echo get_the_title( $p ); ?></a></li>
        <?php endforeach; ?>
        </ul>
    </section>
    <section class="widget_block">
        <h2 class="wp-block-heading">Podcast Archives</h2>
        <select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
            <option value=""><?php esc_attr( _e( 'Select Month', 'textdomain' ) ); ?></option> 
            <?php wp_get_archives( ['type' => 'monthly', 'format' => 'option', 'post_type' => 'podcast'] ); ?>
        </select>
    </section>
</div>