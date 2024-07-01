<?php
/**
 * Title: Old Sidebar
 * Description: The sidebar containing the main widget area
 * Slug: aname/_sidebar
 * Inserter: no
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aname
 * @since 1.0.0
 * @updated 24.2.1
 *
 * todo rewrite to default gutenberg block
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
