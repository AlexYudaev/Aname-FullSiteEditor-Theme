<?php
/**
 * Title: Old Loop List
 * Description: Old loop list with customization
 * Slug: aname/_loop
 * Inserter: no
 *
 *
 * @package aname
 * @since 1.0.0
 * @updated 24.2.1
 *
 * todo rewrite to default gutenberg block
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php if ( have_posts() ) : ?>
    <?php
    /* Start the Loop */
    while ( have_posts() ) :
        the_post();
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'excerpt' ); ?>>
            <header class="entry-header">
                <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
            </header>
            <div class="entry-summary">
                <div class="post-thumbnail">
                    <?php aname_post_thumbnail(); ?>
                </div>

                <div class="post-excerpt">
                    <?php the_excerpt(); ?>

                    <div class="entry-meta">
                        <?php aname_posted_on(); ?>
                        <div class="cat-list"><?php the_category( ', ' ); ?></div>
                        <div class="tag-list"><?php the_tags( '' ); ?></div>
                    </div><!-- .entry-meta -->

                    <div class="read-more">
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="default-btn">
                            <?php esc_html_e( 'Read More', 'aname' ); ?>
                        </a>
                    </div>
                </div>
            </div>
        </article><!-- #post-<?php the_ID(); ?> -->


    <?php
    endwhile;

    the_posts_navigation();

else :

    // todo template for empty content
    // get_template_part( 'template-parts/content', 'none' );

endif;
?>
