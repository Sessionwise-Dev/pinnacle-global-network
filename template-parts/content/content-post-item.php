<div class="blog-post pgn-post-item">
<a href="<?php the_permalink(); ?>" class="full-link"></a>
    <div class="featured-image-container">
        <?php echo has_post_thumbnail() ? the_post_thumbnail( 'medium_large' ) : '<img src="'.get_template_directory_uri().'/dist/images/blog-placeholder.jpg">'; ?>
    </div>
    <div class="blog-post-content">
        <h3 class="blog-post-title"><?php the_title(); ?></h3>
        <div class="blog-post-meta">
            <span class="post-date"><?php echo get_the_date('F j, Y', get_the_ID()); ?></span>
        </div>
        <div class="blog-post-excerpt">
            <?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="read-more theme-button hero">Read More</a>
    </div>
</div>