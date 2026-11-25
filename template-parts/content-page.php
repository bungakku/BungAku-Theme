<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template part for displaying page content in page.php
 *
 * @package BungAku_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( bungaku_theme_should_show_title() ) : ?>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title entry-title--align-' . esc_attr( bungaku_theme_get_title_align() ) . '">', '</h1>' ); ?>
    </header><!-- .entry-header -->
    <?php endif; ?>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail( 'large' ); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bungaku-theme' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
