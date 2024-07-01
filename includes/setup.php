<?php
/**
 * Setup
 *
 * Copyright @ 2023 Alexander Yudaev
 * https://www.alechko.name
 * https://ya.digital
 *
 * @package aname
 * @since 1.0.0
 * @updated 24.2.1
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'aname_setup' ) ) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function aname_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on understrap, use a find and replace
         * to change 'understrap' to the name of your theme in all the template files
         */
        load_child_theme_textdomain( 'aname', get_stylesheet_directory() . '/languages' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary' => __( 'Primary Menu', 'aname' ),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
            )
        );

        /*
         * Adding support for Widget edit icons in customizer
         */
        add_theme_support( 'customize-selective-refresh-widgets' );

        /*
         * Enable support for Post Formats.
         * See https://wordpress.org/support/article/post-formats/
         */
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
            )
        );


        // Set up the WordPress Theme logo feature.
        add_theme_support( 'custom-logo' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

    }
}

add_action( 'after_setup_theme', 'aname_setup' );