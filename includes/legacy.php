<?php
/**
 * Legacy Code
 *
 * Copyright @ 2023 Alexander Yudaev
 * https://www.alechko.name
 * https://ya.digital
 *
 * @package aname
 * @since 1.0.0
 * @updated 24.2.1
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'aname_post_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function aname_post_thumbnail() {
        if ( post_password_required() || is_attachment() ) {
            return;
        }

        if ( has_post_thumbnail() ) :
            the_post_thumbnail( 'thumbnail' );
        else :
            $title = get_the_title();
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
			    <title>'. $title .'</title>
			    <g id="OBJECTS">
			        <rect width="500" height="500" fill="#00aeef"/>
			        <path d="M167,338.7h0a14.9,14.9,0,0,1-6.6-20.1l77.2-152.2a20.9,20.9,0,0,1,19.3-11.5,21.4,21.4,0,0,1,18.4,11.9l49,97.3a20.9,20.9,0,0,1-.8,20.4A21.5,21.5,0,0,1,305,294.6H256a15,15,0,0,1-15-15h0a15,15,0,0,1,15-15h34.9l-34.5-68.8L187.2,332.1A15,15,0,0,1,167,338.7Z" fill="#fff"/>
			        <path d="M332.2,340.4H230.9a15,15,0,1,1,0-30H332.2a15,15,0,0,1,0,30Z" fill="#fff"/>
			        <path d="M201,252.1l-71.6-71.6a15,15,0,0,1,21.2-21.2l71.6,71.6A15,15,0,0,1,201,252.1Z" fill="#fff"/>
			    </g>
			</svg>';
        endif;

        // @codingStandardsIgnoreStart
        /*
         *
         * todo rewtite to wp function
       if ( is_singular() ) :
           ?>

           <div class="post-thumbnail">
               <?php the_post_thumbnail(); ?>
           </div><!-- .post-thumbnail -->

       <?php else : ?>

       <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
           <?php
           the_post_thumbnail( 'post-thumbnail', array(
               'alt' => the_title_attribute( array(
                   'echo' => false,
               ) ),
           ) );
           ?>
       </a>

       <?php
       endif; // End is_singular().

        */
        // @codingStandardsIgnoreEnd
    }
endif;

if ( ! function_exists( 'aname_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function aname_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );
        // @codingStandardsIgnoreStart
        //		$posted_on = sprintf(
        //		/* translators: %s: post date. */
        //			esc_html_x( '%s time', 'post date', 'aname' ),
        //			$time_string
        //		);
        // @codingStandardsIgnoreEnd

        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '<div class="posted-on">' . $time_string . '</div>';
    }
endif;

if ( ! function_exists( 'aname_reading_time' ) ) :
    /**
     * Prints estimate reading time for specific post.
     */
    function aname_reading_time() {
        $content     = get_post_field( 'post_content', get_the_ID() );
        $word_count  = str_word_count( wp_strip_all_tags( $content ) );
        $readingtime = ceil( $word_count / 75 );
        if ( 1 === $readingtime ) {
            $timer = __( ' minute read', 'aname' );
        } else {
            $timer = __( ' minutes read', 'aname' );
        }
        $totalreadingtime = $readingtime . $timer;

        return $totalreadingtime;
    }
endif;