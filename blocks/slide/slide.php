<?php

$template = [['core/paragraph']];

echo is_admin() ? '<div class="admin-block-label admin-slide-label">Slide</div>' : '';

echo '<InnerBlocks class="swiper-slide" template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="false"/>';