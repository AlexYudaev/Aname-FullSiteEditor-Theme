<?php
/**
 * Custom Post Types file
 *
 * Copyright @ 2023 Alexander Yudaev
 * https://www.alechko.name
 * https://ya.digital
 *
 *
 * @package aname
 * @since 18.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function register_cpt_cases() {
    $labels = array(
        'name' => _x('Portfolio', 'post type general name', 'aname'),
        'singular_name' => _x('Portfolio', 'post type singular name', 'aname'),
        'add_new' => _x('Add New', 'portfolio', 'aname'),
        'add_new_item' => __('Add New Portfolio Entry', 'aname'),
        'edit_item' => __('Edit Portfolio Entry', 'aname'),
        'new_item' => __('New Portfolio Entry', 'aname'),
        'view_item' => __('View Portfolio Entry', 'aname'),
        'search_items' => __('Search Portfolio Entries', 'aname'),
        'not_found' => __('No Portfolio Entries found', 'aname'),
        'not_found_in_trash' => __('No Portfolio Entries found in Trash', 'aname'),
        'parent_item_colon' => '',
    );

    $args = array(
        'labels' => $labels,
        'show_in_rest' => true,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array(
            'slug' => 'portfolio',
            'with_front' => true,
        ),
        'query_var' => true,
        'show_in_nav_menus' => false,
        'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'comments'),
    );

    //phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.plugin_territory_register_post_type
    register_post_type('portfolio', $args);


    register_taxonomy("portfolio_entries",
        array("portfolio"),
        array(	"hierarchical" => true,
            "label" => "Portfolio Categories",
            "singular_label" => "Portfolio Categories",
            "rewrite" => true,
            "query_var" => true
        ));
}
add_action('init', 'register_cpt_cases');
