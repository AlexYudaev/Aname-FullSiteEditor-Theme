<?php
/**
 * Title: Socials Share
 * Slug: aname/_socialsShare
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

global $post;
?>
<a href="https://www.facebook.com/sharer.php?u=<?php echo get_permalink( $post->id ); ?>" data-media="facebook">
    <span class="sr-only">Facebook Share</span>
    <svg viewBox="0 0 320 512" class="icon shape-codepen">
        <use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/images/sprites.svg#facebook-f"></use>
    </svg>
</a>
<a href="https://twitter.com/home?status=<?php echo get_permalink( $post->id ); ?>" data-media="twitter">
    <span class="sr-only">Twitter Share</span>
    <svg viewBox="0 0 512 512" class="icon shape-codepen">
        <use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/images/sprites.svg#twitter"></use>
    </svg>
</a>
<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo get_permalink( $post->id ); ?>" data-media="linkedin">
    <span class="sr-only">linkedin Share</span>

    <svg viewBox="0 0 448 512" class="icon shape-codepen">
        <use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/images/sprites.svg#linkedin-in"></use>
    </svg>
</a>
