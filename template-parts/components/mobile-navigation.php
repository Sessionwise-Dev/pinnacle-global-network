<nav id="mobile-nav">

    <i id="nav-close" class="fa-regular fa-sharp fa-xmark"></i>

    <div class="mobile-site-branding">

        <a class="site-logo" href="<?php echo get_home_url(); ?>">

            <?php echo wp_get_attachment_image( $custom_logo_id ) ? wp_get_attachment_image( $custom_logo_id ) : '<span class="text-white font-300">' . get_bloginfo( 'name' ) . '</span>'; ?>

        </a>

    </div>

    <?php
        wp_nav_menu( array (
            'theme_location' => 'mobile_nav',
            'menu_id'        => 'mobile-menu'
        ));
    ?>

    <?php 
        if($header_cta = get_field('header_cta','option')) {
            echo '<a class="theme-button header" href="'.$header_cta['url'].'" target="'.$header_cta['target'].'" ">'.$header_cta['title'].'</a>';
        }
    ?>
    <?php 
        if($header_phone = get_field('header_phone','option')) {
            echo '<a class="primary-phone mt-md text-sky-blue-3" href="' . $header_phone['url'] . '">' . $header_phone['title'] . '</a>';
        }
    ?>

</nav>