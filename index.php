<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * 
 * @package _pinnacle
 * 
 */

get_header();

?>


<?php get_template_part('template-parts/content/content', 'banner'); ?>

<div id="primary" class="blog-archive-container container-x-pad container-y-pad">

	<div class="content-container">

		<div class="blog-inner">

				<?php if( have_posts() ) : ?>
					<div class="blog-posts d-grid cols-2 gap-md">
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

			

			<div class="blog-sidebar">
				<?php get_sidebar(); ?>
			</div>

		</div>

		
	</div>

</div>

<?php

get_footer();
