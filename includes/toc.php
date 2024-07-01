<?php
/**
 * TOC Functions
 *
 * Copyright @ 2023 Alexander Yudaev
 * https://www.alechko.name
 * https://ya.digital
 *
 * Create Table of content and Insert before Content.
 *
 * @package aname
 * @since 21.11.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function anchor_injection_for_h2( $content ) {

    // Regex pattern that we want to match.
    $pattern = '/<h2.*?>(.*?)<\/h2>/';
    $index   = 0;


    $content = preg_replace_callback(
        $pattern,
        //phpcs:ignore PHPCompatibility.FunctionDeclarations.NewClosure.Found
        function ( $matches ) use ( &$index ) {
            $title = $matches[1];
            $index ++;


            preg_match( '/class="(.*?)"/', $matches[0], $classes );
            preg_match( '/id="(.*?)"/', $matches[0], $ids );

            if ( count( $classes ) ) {
                $css_classes = array( 'heading2', $classes[1] );
            } else {
                $css_classes = array( 'heading2' );
            }

            return '<h2 id="title-' . $index . '" class="' . implode( ' ', $css_classes ) . '">' . $title . '</h2>';


        },
        $content
    );

    return $content;
}
add_filter( 'the_content', 'anchor_injection_for_h2' );

/**
 * Create Table of content Shortcode.
 *
 * @param array $attr came from shortcode.
 */
function render_table_of_content( $attr ) {
    $content = get_the_content( get_the_ID() );
    preg_match_all( '/<h2.*?>(.*?)<\/h2>/', $content, $items );

    $headings = $items[0];
    $titles   = $items[1];
    $index    = 0;


    $toc  = '<div id="tableOfContent" class="post__toc">';
    $toc .= '<h2 id="tocHeading" class="heading2">' . __( 'Table of Content', 'aname' ) . '</h2>';
    $toc .= '<ul class="post__toc-list">';

    foreach ( $headings as $heading ) {
        preg_match( '/id="(.*?)" /', $heading, $ids );
        $id = $index + 1;

        $toc .= '<li class="post__toc-item"><a class="post__toc-link" href="#title-' . $id . '">' . $titles[ $index ] . '</a></li>';
        $index ++;
    }
    $toc .= '</ul></div>';

    if ( count( $headings ) ) {
        return $toc;
    } else {
        return;
    }
}
//phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.plugin_territory_add_shortcode
add_shortcode( 'render_toc', 'render_table_of_content' );
