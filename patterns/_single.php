<?php
/**
 * Title: Single php pattern
 * Slug: aname/_single
 * Inserter: no
 *
 * @package aname
 * @since 1.0.0
 * @updated 24.2.1
 *
 * cant create post id and custom single posts classes
 * todo rewrite to default gutenberg block
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- wp:pattern {"slug":"aname/_singleHeader"} /-->
    <!-- wp:pattern {"slug":"aname/_singleThumbnail"} /-->
    <div class="container">
        <div id="rightBar" class="right-bar">
            <?php echo do_shortcode('[render_toc]'); ?>
            <div class="sidebar-share single-share">
                <!-- wp:pattern {"slug":"aname/_socialsShare"} /-->
            </div>
        </div>
    </div>
    <!-- wp:post-content {"layout":{"type":"constrained"}} /-->
    <!-- wp:pattern {"slug":"aname/_singleMeta"} /-->
</article>

<!-- wp:pattern {"slug":"aname/recentPosts"} /-->

<!-- wp:pattern {"slug":"aname/_comments"} /-->
