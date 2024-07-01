<?php
/**
 * Title: Comments Page
 * Description: The template for displaying comments
 * Slug: aname/_comments
 * Inserter: no
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aname
 * @since 1.0.0
 * @updated 24.2.1
 *
 * todo rewrite to default gutenberg block
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<section id="comments" class="comments-area">
    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) :
        ?>
        <div class="comments-headers">
            <h2 class="comments-title">
                <?php
                $comment_count = get_comments_number();

                if ( '1' === $comment_count ) {
                    esc_html_e( 'One thought', 'aname' );
                } else {
                    printf(
                        esc_html__( '%s thoughts', 'aname' ), // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
                        number_format_i18n( $comment_count ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    );
                }
                ?>
            </h2><!-- .comments-title -->

            <?php the_comments_navigation(); ?>
        </div>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'walker'     => new Aname_Walker_Comment(),
                    'style'      => 'ol',
                    'short_ping' => true,
                )
            );
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'aname' ); ?></p>
        <?php
        endif;

    endif; // Check for have_comments().
    ?>

    <div class="comment-form container-small">
        <?php comment_form(); ?>
    </div>

</section><!-- #comments -->
