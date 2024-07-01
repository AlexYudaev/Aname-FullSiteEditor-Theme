<?php
/**
 * Title: Single Header page
 * Slug: aname/_singleHeader
 * Categories: Headers
 *
 * @package aname
 * @since 24.2.1
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<header class="entry-header container-small">
    <?php
    if ( is_singular() ) :
        the_title( '<h1 class="entry-title">', '</h1>' );
    else :
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;

    if ( 'post' === get_post_type() ) :
        ?>
        <div class="entry-exerpt">
            <?php echo get_the_excerpt(); ?>
        </div>

        <div class="entry-meta">
            <?php aname_posted_on(); ?>
            <div class="comments">
                <?php echo get_comments_number_text( 'עדיין אין תגובות', 'תגובה אחת', '% תגובות', 'comments-link', '' ); ?>
            </div>
            <div class="readingTime"><?php echo aname_reading_time(); ?></div>
            <div class="postCounter"><?php echo get_the_ID(); ?><?php echo get_post_meta(get_the_ID(), 'ya_posts_views' , true) ?? 0; ?> <?php _e('Post Views', 'aname'); ?></div>
        </div><!-- .entry-meta -->
    <?php endif; ?>
</header>
