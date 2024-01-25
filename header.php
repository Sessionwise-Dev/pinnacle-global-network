<?php
/**
 *
 * This is the template that displays all of the <head> section and everything up until <main id="content">
 */
$body_class = is_front_page() ? 'hide-content' : '';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda&family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class( $body_class ); ?>><?php wp_body_open(); ?>

	<?php 
    $custom_logo_id = get_theme_mod( 'custom_logo' );
	include( locate_template( 'template-parts/components/mobile-navigation.php' ) );
	//Homepage preloader animation
	if( is_front_page() ){
		echo '<div class="pgn-home-animation">';
			echo '<div class="pgn-home-animation-bg"></div>';
			echo '<div class="pgn-home-animation-logo-wrap d-flex jc-center ai-center">';
				echo '<div class="pgn-home-animation-logo">';
					echo '<div class="overlay"></div>';
					echo wp_get_attachment_image( $custom_logo_id, 'full', false, ['class' => 'no-lazy-load', 'loading' => 'eager'] );
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
	?>
	<?php if( !is_page_template( 'page-landing-page.php' ) ): ?>
	<header id="masthead" class="site-header">

		<?php 
			if(get_field('announcement_text', 'option') && get_field( 'display_announcement_banner' ) ) {
				$announcement_link = get_field('announcement_link','option');
				echo '<div class="announcement-bar"><a href="'.$announcement_link['url'].'" target="'.$announcement_link['target'].'">'.get_field('announcement_text', 'option').' <span class="announcement-cta">'.$announcement_link['title'].'</span></a></div>';
			}
		?>

		<div class="header-inner">

			<div class="header-inner-container">

			<a class="site-logo" href="<?php echo get_home_url(); ?>">
				<?php echo wp_get_attachment_image( $custom_logo_id ) ? wp_get_attachment_image( $custom_logo_id ) : '<span class="text-white font-300">' . get_bloginfo( 'name' ) . '</span>'; ?>
			</a>

			<nav id="site-navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'primary_nav',
					'menu_id'        => 'primary-menu',
					'container'      => false
                )); ?>

				<?php 
					if($header_cta = get_field('header_cta','option')) {
						echo '<a class="theme-button header" href="'.$header_cta['url'].'" target="'.$header_cta['target'].'" ">'.$header_cta['title'].'</a>';
					}
				?>
				<?php 
					if($header_phone = get_field('header_phone','option')) {
						echo '<a class="primary-phone" href="' . $header_phone['url'] . '">' . $header_phone['title'] . '</a>';
					}
				?>
				<div class="menu-icon"><i class="fa-regular fa-bars"></i></div>
				
			</nav>

			</div>

		</div>
		 
	</header>
	<?php endif; ?>

	<main id="content" class="site-content">