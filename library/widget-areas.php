<?php
//Register widget areas here


function _pinnacle_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', '_pinnacle' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', '_pinnacle' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', '_pinnacle_widgets_init' );