<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template part for displaying posts
 *
 * Fixed in 1.7.50: this generic fallback part (used only when a custom
 * post type has no matching content-{posttype}.php) never called
 * bungaku_theme_should_show_title() / bungaku_theme_get_title_align(), unlike
 * content-page.php, content-post.php, and content-blog.php, which all
 * already did. The Title Settings meta box (1.7.27) silently had no
 * effect for any content type routed through this fallback. Ported the
 * same conditional + alignment-class logic already used in content-blog.php.
 *
 * Fixed in 1.7.95: the thumbnail link wrapped only an image, so with an
 * empty alt text (the WordPress default) it had no accessible name (axe
 * "link-name") and added a second tab stop to the same destination as the
 * title link. It now carries aria-hidden="true" tabindex="-1", exactly as
 * related-posts.php already did. Same fix in content-post.php,
 * content-blog.php and the Recent Posts widget.
 *
 * @package BungAku_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php the_post_thumbnail( 'large' ); ?>
            </a>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php
        if ( bungaku_theme_should_show_title() ) :
            $title_align_class = ' entry-title--align-' . esc_attr( bungaku_theme_get_title_align() );
            if ( is_singular() ) :
                the_title( '<h1 class="entry-title' . $title_align_class . '">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title' . $title_align_class . '"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;
        endif;

        if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <span class="posted-on">
                    <?php echo esc_html( get_the_date() ); ?>
                </span>
                <span class="byline">
                    <?php esc_html_e( 'by', 'bungaku-theme' ); ?> <?php the_author_posts_link(); ?>
                </span>
                <span class="comments-link">
                    <?php bungaku_theme_comments_link_markup(); ?>
                </span>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        if ( is_singular() ) :
            the_content( sprintf(
                wp_kses(
                    /* translators: %s: post title (screen-reader only) */
                    __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bungaku-theme' ),
                    array( 'span' => array( 'class' => array() ) )
                ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );
            
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bungaku-theme' ),
                'after'  => '</div>',
            ) );
        else :
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="read-more">
                <?php esc_html_e( 'Read More', 'bungaku-theme' ); ?>
            </a>
        <?php endif; ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
