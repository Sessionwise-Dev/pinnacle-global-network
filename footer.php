<?php
/**
 * The template for displaying the footer
 */


$custom_logo_id = get_theme_mod( 'custom_logo' );
$copyright = get_field('copyright', 'options');

// social icons
$facebook = get_field('facebook', 'options');
$instagram = get_field('instagram', 'options');
$twitter = get_field('twitter', 'options');
$linkedin = get_field('linkedin', 'options');

$contacts_and_location = get_field('contacts_and_location', 'options');
?>

	</main><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-inner">
			<div class="site-info">
				<div class="logo-and-socials">
					<a class="site-logo footer" href="<?php echo get_home_url(); ?>">
						<?php echo wp_get_attachment_image( $custom_logo_id ) ? wp_get_attachment_image( $custom_logo_id, 'large' ) : '<span class="text-white font-300">' . get_bloginfo( 'name' ) . '</span>'; ?>
					</a>
					<?php if( $facebook || $instagram || $twitter || $linkedin ) {?>
						<ul class="footer-socials">
							<?php if($facebook) {
								echo '<li class="facebook"><a href="'.$facebook.'"><i class="fa-brands fa-facebook-f"></i></a></li>';
							} ?>

							<?php if($instagram) {
								echo '<li class="instagram"><a href="'.$instagram.'"><i class="fa-brands fa-instagram"></i></a></li>';
							} ?>

							<?php if($twitter) {
								echo '<li class="twitter"><a href="'.$twitter.'"><i class="fa-brands fa-x-twitter"></i></a></li>';
							} ?>

							<?php if($linkedin) {
								echo '<li class="linkedin"><a href="'.$linkedin.'"><i class="fa-brands fa-linkedin-in"></i></a></li>';
							} ?>
						</ul>
					<?php } ?>
				</div>
				<?php if($contacts_and_location) { ?>
					<div class="contacts-and-location">
						<?php echo $contacts_and_location; ?>
					</div>
				<?php } ?>
			</div>
			
			<?php if($partners = get_field('partner_logos', 'options')) { ?>
				<div class="partner-logos">
					<?php foreach($partners as $partner) { 
						echo wp_get_attachment_image($partner, 'medium');
					} ?>
				</div>
			<?php } ?>
			
		</div>

		<div class="footer-copyright">
			<?php if($copyright) { 
				echo '<p class="copyright-text">'.$copyright.'</p>';
			} else {
				echo '©2023 Pinnacle Global Network';
			} ?>

			<?php wp_nav_menu( array(
				'theme_location' => 'footer_nav',
				'menu_id'        => 'footer-menu',
				'container'      => 'false',
			)); ?>
		</div>
		
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
