<div id="primary" class="blog-archive-container container-x-pad container-y-pad">
	<div class="content-container">
		<div class="blog-inner">
            <?php if( have_posts() ) : ?>
                <div class="blog-posts d-grid cols-2 gap-sm">
                <?php while( have_posts() ) : the_post(); ?>
                    <?php get_template_part('template-parts/content/content', 'post-item'); ?>
                <?php endwhile; ?>

                <?php if( $wp_query->max_num_pages > 1 ): ?>
                    <nav class="numbered-pagination">
                    <?php _pinnacle_numbered_pagination( $wp_query ); ?>
                    </nav>
                <?php endif; ?>
                </div>
            <?php endif; ?>
			<?php get_template_part( 'template-parts/content/blog-sidebar' ); ?>
		</div>
	</div>
</div>