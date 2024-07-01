<?php
/**
 * Title: Single Header page
 * Slug: aname/_singleThumbnail
 * Inserter: no
 *
 * @package aname
 * @since 24.2.1
 *
 * todo rewrite to default gutenberg block
 */

//phpcs:ignore Generic.Strings.UnnecessaryStringConcat.Found
$thumb = 'style="background-image: url(' . get_stylesheet_directory_uri() . '/images/code.webp' . ')"';
?>
<div class="entry-thumb" <?php echo $thumb; ?>>
    <?php aname_post_thumbnail(); ?>
</div>
