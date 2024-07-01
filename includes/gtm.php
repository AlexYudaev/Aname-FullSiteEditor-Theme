<?php
/**
 * Custom GTM form
 *
 * Copyright @ 2023 Alexander Yudaev
 * https://www.alechko.name
 * https://ya.digital
 *
 * @package aname
 * @since 21.11.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function add_header_gmt_code(){

}

add_action('wp_head', 'add_header_gmt_code');
