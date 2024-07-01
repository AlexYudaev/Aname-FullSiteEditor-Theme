<?php
/**
 * Title:Recent Posts
 * Slug: aname/recentPosts
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
<section class="recent-posts">
    <div class="container">
        <h3>מאמרים נוספים<?php __( 'Recent Posts', 'aname' ); ?></h3>
        <?php // todo remove it. ?>
        <?php
        global $post;

        $tag_objects = wp_get_post_tags( $post->ID );
        $tags        = array();
        foreach ( $tag_objects as $tag_object ) {
            $tags[] = $tag_object->term_id;
        }
        $myposts = get_posts(
            array(
                'numberposts'  => 3,
                'offset'       => 0,
                'post__not_in' => array( get_the_ID() ),
                'post_status'  => 'publish',
                'order'        => 'DESC',
            )
        );

        foreach ( $myposts as $mypost ) :
            ?>
            <div class="single-item">
                <div class="thumbnail">
                    <a href="<?php echo get_the_permalink( $mypost->ID ); ?>">

                        <?php // todo rewrite. ?>
                        <?php
                        if ( has_post_thumbnail( $mypost->ID ) ) :
                            echo get_the_post_thumbnail( $mypost->ID, 'post-thumbnail' );
                        else :
                            ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
                                <title><?php echo get_the_title( $mypost->ID ); ?>></title>
                                <g id="OBJECTS">
                                    <rect width="400" height="400" fill="#00aeef"></rect>
                                    <path d="M167,338.7h0a14.9,14.9,0,0,1-6.6-20.1l77.2-152.2a20.9,20.9,0,0,1,19.3-11.5,21.4,21.4,0,0,1,18.4,11.9l49,97.3a20.9,20.9,0,0,1-.8,20.4A21.5,21.5,0,0,1,305,294.6H256a15,15,0,0,1-15-15h0a15,15,0,0,1,15-15h34.9l-34.5-68.8L187.2,332.1A15,15,0,0,1,167,338.7Z" fill="#fff"></path>
                                    <path d="M332.2,340.4H230.9a15,15,0,1,1,0-30H332.2a15,15,0,0,1,0,30Z" fill="#fff"></path>
                                    <path d="M201,252.1l-71.6-71.6a15,15,0,0,1,21.2-21.2l71.6,71.6A15,15,0,0,1,201,252.1Z" fill="#fff"></path>
                                </g>
                            </svg>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="description">
                    <span><?php echo get_the_date( '', $mypost->ID ); ?></span>
                    <a href="<?php echo get_the_permalink( $mypost->ID ); ?>">
                        <?php echo get_the_title( $mypost->ID ); ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
