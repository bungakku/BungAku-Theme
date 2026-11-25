<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Customizer Settings - Orchestrator
 *
 * @package BungAku_Theme
 */

require_once BUNGAKU_THEME_DIR . '/inc/customizer/layout-panel.php';
require_once BUNGAKU_THEME_DIR . '/inc/customizer/typography-panel.php';
require_once BUNGAKU_THEME_DIR . '/inc/customizer/colors-panel.php';
require_once BUNGAKU_THEME_DIR . '/inc/customizer/blog-panel.php';
require_once BUNGAKU_THEME_DIR . '/inc/customizer/contact-social-panel.php';

function bungaku_theme_customize_register( $wp_customize ) {
    bungaku_theme_register_layout_panel( $wp_customize );
    bungaku_theme_register_typography_panel( $wp_customize );
    bungaku_theme_register_colors_panel( $wp_customize );
    bungaku_theme_register_blog_panel( $wp_customize );
}
add_action( 'customize_register', 'bungaku_theme_customize_register' );
