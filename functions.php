<?php

/**
 * Aname functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aname
 * @since 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if ( ! defined( 'ANAME_VERSION' ) ) {
    $theme = wp_get_theme();
    // Get theme version from style.css file
    define( 'ANAME_VERSION', $theme->Version );
}

$includes_folder = 'includes';

// Array of files to include.
$includes_files = array(
    '/setup.php',                           // Theme setup and custom theme supports.
    '/enqueue.php',                         // Enqueue scripts and styles.
    '/toc.php',                             // Load Table of Content.
    '/widgets.php',                         // Register widget area.
    '/cpt.php',                             // Register Custom Post types
    '/class-ya-post-view.php',              // View Post Counter
    '/gtm.php',                             // Google Tag manager
    '/legacy.php',                          // Legacy code todo remove it
);

// Include themes files files.
foreach ( $includes_files as $file ) {
    require_once get_theme_file_path( $includes_folder . $file );
}