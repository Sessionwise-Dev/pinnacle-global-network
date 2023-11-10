<div class="blog-post">
    <div class="featured-image-container">
        <?php echo has_post_thumbnail() ? the_post_thumbnail( 'medium_large' ) : '<img style="background: #bbb;" src="'.get_template_directory_uri().'/src/images/placeholder-image.png">'; ?>
    </div>
    <div class="blog-post-content">
        <h3 class="blog-post-title"><?php the_title(); ?></h3>
        <div class="blog-post-meta">
            <span class="post-date"><?php echo get_the_date('F j, Y', get_the_ID()); ?></span>
        </div>
        <div class="blog-post-excerpt">
            <?php echo substr(get_the_excerpt(), 0, 200).' ....'; ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="read-more theme-button primary">Read More</a>
    </div>
</div>