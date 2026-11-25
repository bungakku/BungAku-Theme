<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * The template for displaying all single posts
 *
 * @package BungAku_Theme
 */

get_header(); ?>

<div class="container">
    <div class="content-area <?php echo is_active_sidebar( 'sidebar-1' ) ? 'has-sidebar' : 'no-sidebar'; ?>">
        <main id="primary" class="primary">
            <?php
            while ( have_posts() ) :
                the_post();
                
                // Added in 1.7.96: a post type keyed "none" would load
                // content-none.php ("Nothing found", no body); use content.php.
                $bungaku_theme_part = get_post_type();
                if ( 'none' === $bungaku_theme_part ) {
                    $bungaku_theme_part = '';
                }
                get_template_part( 'template-parts/content', $bungaku_theme_part );
                
                the_post_navigation( array(
                    'prev_text' => '&laquo; ' . __( 'Previous Post', 'bungaku-theme' ),
                    'next_text' => __( 'Next Post', 'bungaku-theme' ) . ' &raquo;',
                ) );
                
                if ( function_exists( 'bungaku_theme_author_bio' ) ) {
                    bungaku_theme_author_bio();
                }
                
                if ( function_exists( 'bungaku_theme_related_posts' ) ) {
                    bungaku_theme_related_posts();
                }
                
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                
            endwhile;
            ?>
        </main><!-- #primary -->

        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <aside id="secondary" class="secondary">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </aside><!-- #secondary -->
        <?php endif; ?>
    </div><!-- .content-area -->
</div><!-- .container -->

<?php
get_footer();
