<?php
/**
 * Enqueue Scripts and styles
 *
 * Copyright @ 2023 Alexander Yudaev
 * https://www.alechko.name
 * https://ya.digital
 *
 * @package aname
 * @since 15.11.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function aname_enqueue_scripts()
{
    wp_enqueue_style('style', get_stylesheet_uri(), array(), ANAME_VERSION);

    wp_enqueue_script('jquery');

    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), ANAME_VERSION, true );
    wp_enqueue_script( 'prismjs', get_stylesheet_directory_uri() . '/js/prism.js', array(), '1.19.0', true );
    wp_localize_script(
        'scripts',
        'ajax_object',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );

}

add_action('wp_enqueue_scripts', 'aname_enqueue_scripts', 100);
