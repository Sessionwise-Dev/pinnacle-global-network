<?php

get_header();

?>

<div id="primary" class="blog-post-container container-x-pad container-y-pad">

	<div class="content-container">

		<div class="blog-post-inner">

			<div class="blog-post-content">
				<div class="featured-image-container">
					<?php echo has_post_thumbnail() ? the_post_thumbnail( 'medium_large' ) : '<img style="background: #bbb;" src="'.get_template_directory_uri().'/src/images/placeholder-image.png">'; ?>
				</div>
				
				<h1 class="blog-post-title"><?php the_title(); ?></h1>
				<div class="blog-post-meta">
					<span class="post-date"><?php echo get_the_date('F j, Y', get_the_ID()); ?></span>
				</div>

				<div class="blog-post-content">
					<?php the_content(); ?>
				</div>
			</div>

			<div class="blog-sidebar">
				<?php get_sidebar(); ?>
			</div>

		</div>

		
	</div>

</div>

<?php

get_footer();
