<?php
/**
 * Title: Old Portfolio template
 * Description: The sidebar containing the main widget area
 * Slug: aname/_oldPortfolio
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

<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
        $loop  = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 100 ) );
        $count = 0;
        ?>
        <div id="portfolio-wrapper">
            <ul id="portfolio-list">
                <?php if ( $loop ) :
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $terms = get_the_terms( get_the_ID(), 'portfolio_entries' );

                        if ( $terms && ! is_wp_error( $terms ) ) :
                            $links = array();
                            foreach ( $terms as $term ) {
                                $links[] = $term->slug;
                            }
                            $links = str_replace( ' ', '-', $links );
                            $tax   = join( " ", $links );
                        else :
                            $tax = '';
                        endif;
                        $infos = get_post_custom_values( '_url' ); ?>

                        <li class="portfolio-item">
                            <div class="single-portfolio">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                            <div class="portfoliodesc">
                                <div class="desc">
                                    <h3>
                                        <?php the_title(); ?>
                                    </h3>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; else: ?>
                <?php endif; ?>

            </ul>

        </div>
    </div>
</article>
