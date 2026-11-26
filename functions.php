<?php
/**
 * BungAku-Theme functions and definitions
 *
 * @package BungAku_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'BUNGAKU_THEME_VERSION', '1.8.0' );
define( 'BUNGAKU_THEME_DIR', get_template_directory() );
define( 'BUNGAKU_THEME_URI', get_template_directory_uri() );
define( 'BUNGAKU_THEME_ASSETS', BUNGAKU_THEME_URI . '/assets' );

/**
 * Includes
 *
 * Order matters only in that everything below must load before WordPress
 * fires its first action hook (after_setup_theme onward) -- since every
 * function in this theme is registered via add_action/add_filter rather
 * than called immediately, there is no other ordering dependency between
 * these files. Grouped here for one clear list of "what this theme loads".
 */
require_once BUNGAKU_THEME_DIR . '/inc/class-recent-posts-widget.php';
require_once BUNGAKU_THEME_DIR . '/inc/customizer-sanitizers.php';
require_once BUNGAKU_THEME_DIR . '/inc/customizer-css.php';
require_once BUNGAKU_THEME_DIR . '/inc/customizer.php';
require_once BUNGAKU_THEME_DIR . '/inc/github-updater.php';
require_once BUNGAKU_THEME_DIR . '/inc/title-settings.php';

/**
 * Theme Setup
 */
function bungaku_theme_setup() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 200,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );
    
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );
    
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => esc_html__( 'Primary', 'bungaku-theme' ),
            'slug'  => 'primary',
            'color' => '#0274be',
        ),
        array(
            'name'  => esc_html__( 'Secondary', 'bungaku-theme' ),
            'slug'  => 'secondary',
            'color' => '#3a3a3a',
        ),
        array(
            'name'  => esc_html__( 'Dark Grey', 'bungaku-theme' ),
            'slug'  => 'dark-grey',
            'color' => '#333333',
        ),
        array(
            'name'  => esc_html__( 'Light Grey', 'bungaku-theme' ),
            'slug'  => 'light-grey',
            'color' => '#666666',
        ),
        array(
            'name'  => esc_html__( 'White', 'bungaku-theme' ),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
    ) );
    
    add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => esc_html__( 'Small', 'bungaku-theme' ),
            'size' => 14,
            'slug' => 'small',
        ),
        array(
            'name' => esc_html__( 'Normal', 'bungaku-theme' ),
            'size' => 16,
            'slug' => 'normal',
        ),
        array(
            'name' => esc_html__( 'Large', 'bungaku-theme' ),
            'size' => 20,
            'slug' => 'large',
        ),
        array(
            'name' => esc_html__( 'Huge', 'bungaku-theme' ),
            'size' => 28,
            'slug' => 'huge',
        ),
    ) );
    
    add_theme_support( 'custom-line-height' );
    add_theme_support( 'custom-spacing' );
    
    add_image_size( 'bungaku-theme-thumbnail', 300, 200, true );
    
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'bungaku-theme' ),
        'footer'  => esc_html__( 'Footer Menu', 'bungaku-theme' ),
    ) );
    
    load_theme_textdomain( 'bungaku-theme', BUNGAKU_THEME_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'bungaku_theme_setup' );

/**
 * Set content width
 */
function bungaku_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'bungaku_theme_content_width', 1140 );
}
add_action( 'after_setup_theme', 'bungaku_theme_content_width', 0 );

/**
 * Register Widget Areas
 */
function bungaku_theme_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'bungaku-theme' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Main sidebar that appears on posts and pages.', 'bungaku-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    for ( $i = 1; $i <= 4; $i++ ) {
        register_sidebar( array(
            /* translators: %d: footer widget column number */
            'name'          => sprintf( esc_html__( 'Footer Widget Area %d', 'bungaku-theme' ), $i ),
            'id'            => 'footer-' . $i,
            /* translators: %d: footer widget column number */
            'description'   => sprintf( esc_html__( 'Add widgets for footer column %d.', 'bungaku-theme' ), $i ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
    
    register_widget( 'BungAku_Theme_Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'bungaku_theme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function bungaku_theme_scripts() {
    wp_enqueue_style( 'bungaku-theme-style', get_stylesheet_uri(), array(), BUNGAKU_THEME_VERSION );
    
    $customizer_css = bungaku_theme_get_cached_customizer_css();
    if ( ! empty( $customizer_css ) ) {
        wp_add_inline_style( 'bungaku-theme-style', $customizer_css );
    }
    
    wp_enqueue_script( 'bungaku-theme-navigation', BUNGAKU_THEME_URI . '/assets/js/navigation.js', array(), BUNGAKU_THEME_VERSION, true );
    
    wp_localize_script( 'bungaku-theme-navigation', 'bungakuThemeVars', array(
        'menuText' => esc_html__( 'Menu', 'bungaku-theme' ),
        'closeText' => esc_html__( 'Close', 'bungaku-theme' ),
    ) );
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'bungaku_theme_scripts' );

/**
 * Add the theme version to the RTL stylesheet URL (1.7.83).
 *
 * WordPress prints rtl.css itself (locale_stylesheet()) and leaves the ?ver=
 * query string off, so a browser could keep serving an old copy after a theme
 * update. The filter receives an empty string when no localized stylesheet
 * applies, and that is passed through untouched.
 *
 * @param string $uri Localized stylesheet URI.
 * @return string
 */
function bungaku_theme_locale_stylesheet_version( $uri ) {
    return $uri ? add_query_arg( 'ver', BUNGAKU_THEME_VERSION, $uri ) : $uri;
}
add_filter( 'locale_stylesheet_uri', 'bungaku_theme_locale_stylesheet_version' );

/**
 * Enqueue Customizer preview script
 */
function bungaku_theme_customize_preview_js() {
    if ( is_customize_preview() ) {
        wp_enqueue_script( 'bungaku-theme-customizer-preview', BUNGAKU_THEME_URI . '/assets/js/customizer-preview.js', array( 'jquery', 'customize-preview' ), BUNGAKU_THEME_VERSION, true );
    }
}
add_action( 'customize_preview_init', 'bungaku_theme_customize_preview_js' );

/**
 * Enqueue Customizer controls script (contrast and accent text warnings, added in 1.8.0)
 */
function bungaku_theme_customize_controls_js() {
    wp_enqueue_script( 'bungaku-theme-customizer-controls', BUNGAKU_THEME_URI . '/assets/js/customizer-controls.js', array( 'customize-controls' ), BUNGAKU_THEME_VERSION, true );
    wp_localize_script( 'bungaku-theme-customizer-controls', 'bungakuThemeControls', array(
        /* translators: %s: contrast ratio, for example 3.28 */
        'contrastLow'   => __( 'Contrast with the header background is %s:1, below the 3:1 minimum for large text. The title may be hard to read.', 'bungaku-theme' ),
        /* translators: %s: contrast ratio, for example 3.28 */
        'contrastLarge' => __( 'Contrast with the header background is %s:1: enough for large text only (3:1). Body text needs 4.5:1.', 'bungaku-theme' ),
        'accentMissing' => __( 'This text was not found in the Site Title, so the title stays one colour.', 'bungaku-theme' ),
    ) );
}
add_action( 'customize_controls_enqueue_scripts', 'bungaku_theme_customize_controls_js' );

/**
 * Add custom classes to body
 */
function bungaku_theme_body_classes( $classes ) {
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }
    
    $sidebar_position = get_theme_mod( 'bungaku_theme_sidebar_position', 'right' );
    $sidebar_position = sanitize_html_class( $sidebar_position, 'right' );
    $classes[] = 'sidebar-' . $sidebar_position;
    
    if ( get_theme_mod( 'bungaku_theme_sticky_header', false ) ) {
        $classes[] = 'has-sticky-header';
    }
    
    return $classes;
}
add_filter( 'body_class', 'bungaku_theme_body_classes' );

/**
 * Custom excerpt length
 */
function bungaku_theme_excerpt_length( $length ) {
    return get_theme_mod( 'bungaku_theme_excerpt_length', 30 );
}
add_filter( 'excerpt_length', 'bungaku_theme_excerpt_length' );

/**
 * Custom excerpt more
 */
function bungaku_theme_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'bungaku_theme_excerpt_more' );

/**
 * Add menu descriptions
 *
 * Fixed in 1.7.49: this filter previously injected .menu-description markup
 * for ANY primary/footer menu item that had a description set (Appearance >
 * Menus > Screen Options > Description), completely ignoring the "Show Menu
 * Descriptions" Customizer setting (Layout Settings > Menu Settings) that
 * exists specifically to toggle this on/off. The setting defaulted to false
 * but had no actual effect -- descriptions rendered regardless the moment an
 * admin filled in that field. Now gated on the theme mod, matching what the
 * control's label already promised.
 */
function bungaku_theme_add_menu_descriptions( $item_output, $item, $depth, $args ) {
    if ( ! get_theme_mod( 'bungaku_theme_show_menu_descriptions', false ) ) {
        return $item_output;
    }
    if ( ! empty( $item->description ) && in_array( $args->theme_location, array( 'primary', 'footer' ) ) ) {
        $item_output = str_replace( '</a>', '<span class="menu-description">' . esc_html( $item->description ) . '</span></a>', $item_output );
    }
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'bungaku_theme_add_menu_descriptions', 10, 4 );

/**
 * Author bio template
 */
function bungaku_theme_author_bio() {
    if ( ! is_single() ) {
        return;
    }
    if ( get_theme_mod( 'bungaku_theme_show_author_bio', true ) ) {
        get_template_part( 'template-parts/author-bio' );
    }
}

/**
 * Related posts template
 */
function bungaku_theme_related_posts() {
    if ( ! is_single() ) {
        return;
    }
    if ( get_theme_mod( 'bungaku_theme_show_related_posts', true ) ) {
        get_template_part( 'template-parts/related-posts' );
    }
}

/**
 * Shared "N Comments" link markup.
 *
 * Added in 1.7.45: this exact block (compute singular/plural + screen-reader
 * text, then print the comments_link() anchor) was duplicated verbatim
 * across template-parts/content.php, content-blog.php, and content-post.php.
 * Extracted into one helper so future changes to comment-count wording only
 * need to happen once. Output is byte-for-byte identical to the previous
 * inline code in all three callers.
 */
function bungaku_theme_comments_link_markup() {
    $comment_count = get_comments_number();
    if ( $comment_count == 0 ) {
        $comments_text = __( '0 Comments', 'bungaku-theme' );
        $screen_reader_text = __( '0 comments', 'bungaku-theme' );
    } elseif ( $comment_count == 1 ) {
        $comments_text = __( '1 Comment', 'bungaku-theme' );
        $screen_reader_text = __( '1 comment', 'bungaku-theme' );
    } else {
        /* translators: %s: number of comments */
        $comments_text = sprintf( __( '%s Comments', 'bungaku-theme' ), number_format_i18n( $comment_count ) );
        /* translators: %s: number of comments */
        $screen_reader_text = sprintf( __( '%s comments', 'bungaku-theme' ), number_format_i18n( $comment_count ) );
    }
    ?>
    <a href="<?php comments_link(); ?>">
        <span aria-hidden="true"><?php echo esc_html( $comments_text ); ?></span>
        <span class="screen-reader-text"><?php echo esc_html( $screen_reader_text ); ?></span>
    </a>
    <?php
}

/**
 * Convert a formatted phone number (e.g. "+1 (234) 567-8901") into a
 * tel: URI-safe value by stripping everything except digits and a
 * leading "+" for international numbers.
 *
 * Added in 1.7.56 alongside making header.php's phone numbers clickable.
 * Kept as a small standalone helper (matching bungaku_theme_get_color_var(),
 * bungaku_theme_get_contrast_color(), etc.) since it's used twice in header.php
 * and the display text itself is left untouched -- only the href value
 * needs sanitizing to a dialable format.
 */
function bungaku_theme_get_tel_href( $phone ) {
    return preg_replace( '/[^0-9+]/', '', $phone );
}

/**
 * Split the site name around the accent text (Customizer > Colors > Site
 * Title Accent Text).
 *
 * Added in 1.8.0. Returns array( before, accent, after ) cut from the site
 * name (first match, case-insensitive, the accent keeps the name's own
 * casing), or null when the accent text is empty or not part of the name,
 * in which case the title is printed exactly as before. WordPress stores
 * the site name HTML-escaped (St Mary&#039;s), so it is decoded first and
 * each part is escaped again when printed.
 */
function bungaku_theme_get_site_title_parts() {
    $accent = trim( (string) get_theme_mod( 'bungaku_theme_title_accent_text', '' ) );
    if ( '' === $accent ) {
        return null;
    }

    $name = wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES );
    if ( ! preg_match( '/' . preg_quote( $accent, '/' ) . '/iu', $name, $match, PREG_OFFSET_CAPTURE ) ) {
        return null;
    }

    return array(
        substr( $name, 0, $match[0][1] ),
        $match[0][0],
        substr( $name, $match[0][1] + strlen( $match[0][0] ) ),
    );
}

/**
 * Print the site title text for header.php: the plain site name, or the
 * name with its accent part wrapped in a span (added in 1.8.0).
 */
function bungaku_theme_the_site_title() {
    $parts = bungaku_theme_get_site_title_parts();
    if ( null === $parts ) {
        bloginfo( 'name' );
        return;
    }

    foreach ( $parts as $index => $text ) {
        if ( '' === $text ) {
            continue;
        }
        // Same filters as bloginfo( 'name' ); esc_html() does not double-encode.
        $text = esc_html( apply_filters( 'bloginfo', $text, 'name' ) );
        echo ( 1 === $index ) ? '<span class="site-title-accent">' . $text . '</span>' : $text;
    }
}

/**
 * Header logo: the uploaded logo, the bundled default, or none.
 *
 * Added in 1.8.0. "Show a logo in the header" off: no logo, whichever one is
 * uploaded. On with no uploaded logo: the bundled BungAku logo mark. On
 * with an uploaded logo: core's markup, unchanged. Core's selective refresh
 * of the logo calls get_custom_logo() too, so the Customizer preview agrees.
 * Core prints a hidden placeholder in the preview when no logo is set, so
 * has_custom_logo() is checked rather than an empty string.
 *
 * The default is decorative (the site title next to it names the site), so
 * its link is hidden from assistive technology and the tab order, as the
 * duplicate thumbnail links are (1.7.95). It is shown at half its 192px
 * width so it stays sharp on 2x screens.
 */
function bungaku_theme_custom_logo( $html, $blog_id = 0 ) {
    if ( ! get_theme_mod( 'bungaku_theme_show_logo', true ) ) {
        return '';
    }
    if ( has_custom_logo( $blog_id ) ) {
        return $html;
    }

    return sprintf(
        '<a href="%1$s" class="custom-logo-link" rel="home" aria-hidden="true" tabindex="-1"><img src="%2$s" class="custom-logo" alt="" width="96" height="68" decoding="async" /></a>',
        esc_url( home_url( '/' ) ),
        esc_url( BUNGAKU_THEME_URI . '/assets/images/bungaku-logo-mark.png' )
    );
}
add_filter( 'get_custom_logo', 'bungaku_theme_custom_logo', 10, 2 );

/**
 * Security: Remove unnecessary head items
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );

/**
 * Check WordPress version
 */
function bungaku_theme_version_check() {
    if ( version_compare( $GLOBALS['wp_version'], '5.0', '<' ) ) {
        add_action( 'admin_notices', 'bungaku_theme_upgrade_notice' );
    }
}
add_action( 'after_switch_theme', 'bungaku_theme_version_check' );

/**
 * Admin notice for older WordPress versions
 */
function bungaku_theme_upgrade_notice() {
    if ( ! current_user_can( 'switch_themes' ) ) {
        return;
    }
    ?>
    <div class="notice notice-warning is-dismissible">
        <p><?php esc_html_e( 'Your WordPress version is outdated. BungAku-Theme requires WordPress 5.0 or newer for full functionality.', 'bungaku-theme' ); ?></p>
    </div>
    <?php
}
