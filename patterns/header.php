<?php
/**
 * Title: Custom Header includes
 * Slug: aname/header
 * Categories: Headers
 *
 * @package aname
 * @since 24.2.1
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<?php wp_body_open(); ?>

<div class="container polygon-right">
        <div class="site-branding" role="navigation" aria-expanded="false">
            <?php
            $description = get_bloginfo( 'description' );
            $title       = get_bloginfo( 'name' ); //phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            ?>

            <?php if ( is_front_page() ) : ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <span class="title"><?php echo $title; ?></span>
                        <span class="description"><?php echo $description; ?></span>
                    </a>
                </h1>

            <?php else : ?>
                <div class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <span class="title"><?php echo $title; ?></span>
                        <span class="description"><?php echo $description; ?></span>
                    </a>
                </div>

            <?php endif; ?>
            <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="screen-reader-text sr-only"><?php esc_html_e( 'Primary Menu', 'aname' ); ?></span>
                <span class="icon-bar" aria-hidden="true"></span>
                <span class="icon-bar transparent" aria-hidden="true"></span>
                <span class="icon-bar" aria-hidden="true"></span>
            </button>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav',
                )
            );
            ?>
        </nav><!-- #site-navigation -->
    </div>
