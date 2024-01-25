<?php

get_header();
$prev = get_previous_post();
$next = get_next_post();
if( get_post_type() == 'post' ) $categories = get_the_category();

?>

<div id="primary" class="blog-post-container container-x-pad container-y-pad">

	<div class="content-container">

		<div class="blog-post-inner">

			<div class="blog-post-content">
				
				<h1 class="blog-post-title wp-block-heading mt-none"><?php the_title(); ?></h1>
				<div class="blog-post-meta mt-sm">
					<p class="wp-block-paragraph post-date"><i class="fa-solid fa-calendar"></i><?php echo get_the_date( 'F j, Y' ); ?></p>
					<?php
					if( !empty( $categories ) ){
						echo '<span class="divider">|</span>';
						echo '<div class="post-categories">';
							$i = 0;
							foreach( $categories as $cat ){
								echo $i != 0 ? ', ' : 'Categories: ';
								echo '<a href="' . get_category_link( $cat ) . '">' . $cat->name . '</a>';
								$i++;
							}
						echo '</div>';
					} ?>
				</div>

				<div class="blog-post-content mt-md">
					<?php the_content(); ?>
					<?php get_template_part( 'template-parts/components/social-sharing' ); ?>
					<nav class="d-grid cols-2 gap-md ai-center blog-post-pagination mt-lg">
						<?php echo !empty( $prev ) ? '<div class="blog-post-pagination-prev"><a href="' . get_the_permalink( $prev ) . '"><i class="fa-regular fa-long-arrow-left"></i> ' . get_the_title( $prev ) . '</a></div>' : ''; ?>
						<?php echo !empty( $next ) ? '<div class="blog-post-pagination-next"><a href="' . get_the_permalink( $next ) . '">' . get_the_title( $next ) . ' <i class="fa-regular fa-long-arrow-right"></i></a></div>' : ''; ?>
					</nav>
				</div>
			</div>

			<?php get_template_part( 'template-parts/content/blog-sidebar' ); ?>

		</div>

		
	</div>

</div>

<?php

get_footer();
