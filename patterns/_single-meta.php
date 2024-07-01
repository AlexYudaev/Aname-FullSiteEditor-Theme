<?php
/**
* Title: Single Post Meta
* Slug: aname/_singleMeta
* Inserter: no
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

<footer class="entry-footer">
    <div class="meta">
        <div class="cat-list"><i class="icon-folder-open"></i> <?php the_category( ', ' ); ?></div>
        <div class="tag-list"><i class="icon-tags"></i> <?php the_tags( '' ); ?></div>
    </div>
    <div class="single-share">
        <!-- wp:pattern {"slug":"aname/_socialsShare"} /-->
    </div>


    <?php if ( get_the_author_meta( 'description' ) && get_theme_mod( 'show_author_bio', true ) ) : ?>
        <div class="author-bio">
            <div class="author-title-wrapper">
                <div class="author-avatar vcard">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 160 ); ?>
                </div>
                <div class="author-description">
                    <h3><?php _e( 'By', 'aname' ); ?></h3>
                    <h2 class="author-title heading-size-4">
                        <?php echo esc_html( get_the_author() ); ?>
                    </h2>
                    <?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
                </div>
            </div><!-- .author-description -->
        </div><!-- .author-bio -->
    <?php endif; ?>
</footer><!-- .entry-footer -->