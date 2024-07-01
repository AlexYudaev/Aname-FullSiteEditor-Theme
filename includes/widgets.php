<?php
/**
 * Widgets Area implementations
 * *
 * Copyright @ 2023 Alexander Yudaev
 * https://www.alechko.name
 * https://ya.digital
 *
 * @link https://developer.wordpress.org/themes/functionality/widgets/
 *
 * @package aname
 * @since 1.0.0
 * @updated 24.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function aname_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'aname' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'aname' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'aname_widgets_init' );
