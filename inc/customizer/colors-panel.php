<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function bungaku_theme_register_colors_panel( $wp_customize ) {
    
    $wp_customize->add_panel( 'bungaku_theme_colors_panel', array(
        'title'       => __( 'Colors', 'bungaku-theme' ),
        'priority'    => 50,
    ) );
    
    $wp_customize->add_section( 'bungaku_theme_colors_general_section', array(
        'title'       => __( 'General Colors', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_colors_panel',
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_header_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_header_bg', array(
        'label'    => __( 'Header Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_general_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_site_title_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_site_title_color', array(
        'label'    => __( 'Site Title Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_general_section',
    ) ) );

    // 1.8.0: colour one part of the site title differently (empty text = off).
    $wp_customize->add_setting( 'bungaku_theme_title_accent_text', array(
        'default'           => '',
        'sanitize_callback' => 'bungaku_theme_sanitize_title_accent_text',
    ) );
    $wp_customize->add_control( 'bungaku_theme_title_accent_text', array(
        'label'       => __( 'Site Title Accent Text', 'bungaku-theme' ),
        'description' => __( 'Part of the site title to show in the accent colour, typed as it appears in the title (for example "Aku" in BungAku). Leave empty for a one-colour title.', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_colors_general_section',
        'type'        => 'text',
        'input_attrs' => array( 'maxlength' => 60 ),
    ) );

    $wp_customize->add_setting( 'bungaku_theme_title_accent_color', array(
        'default'           => '#cc4a0a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_title_accent_color', array(
        'label'    => __( 'Site Title Accent Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_general_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_site_description_color', array(
        'default'           => '#666666',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_site_description_color', array(
        'label'    => __( 'Site Description Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_general_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_tagline_color', array(
        'default'           => '#666666',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_tagline_color', array(
        'label'    => __( 'Tagline Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_general_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_menu_color', array(
        'default'           => '#3a3a3a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_menu_color', array(
        'label'    => __( 'Primary Menu Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_general_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_heading_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_heading_color', array(
        'label'    => __( 'Heading Color (H1, H2, etc.)', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_general_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_text_color', array(
        'label'    => __( 'Body Text Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_general_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_link_color', array(
        'default'           => '#0274be',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_link_color', array(
        'label'    => __( 'Link Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_general_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_link_hover_color', array(
        'default'           => '#3a3a3a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_link_hover_color', array(
        'label'    => __( 'Link Hover Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_general_section',
    ) ) );
    
    $wp_customize->add_section( 'bungaku_theme_colors_dropdown_section', array(
        'title'       => __( 'Dropdown Menu Colors', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_colors_panel',
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_dropdown_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_dropdown_bg', array(
        'label'    => __( 'Dropdown Menu Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_dropdown_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_dropdown_text', array(
        'default'           => '#3a3a3a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_dropdown_text', array(
        'label'    => __( 'Dropdown Menu Text Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_dropdown_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_dropdown_hover_bg', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_dropdown_hover_bg', array(
        'label'    => __( 'Dropdown Menu Hover Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_dropdown_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_dropdown_hover_text', array(
        'default'           => '#0274be',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_dropdown_hover_text', array(
        'label'    => __( 'Dropdown Menu Hover Text Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_colors_dropdown_section',
    ) ) );

    $wp_customize->add_section( 'bungaku_theme_tablet_menu_colors_section', array(
        'title'       => __( 'Tablet Menu Colors', 'bungaku-theme' ),
        'description' => __( 'Applies between 481px and 768px wide screens.', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_colors_panel',
        'priority'    => 65,
    ) );

    $wp_customize->add_setting( 'bungaku_theme_tablet_menu_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_tablet_menu_bg', array(
        'label'    => __( 'Tablet Menu Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_tablet_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_tablet_menu_text', array(
        'default'           => '#3a3a3a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_tablet_menu_text', array(
        'label'    => __( 'Tablet Menu Text', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_tablet_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_tablet_menu_hover_bg', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_tablet_menu_hover_bg', array(
        'label'    => __( 'Tablet Menu Hover Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_tablet_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_tablet_menu_hover_text', array(
        'default'           => '#0274be',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_tablet_menu_hover_text', array(
        'label'    => __( 'Tablet Menu Hover Text', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_tablet_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_tablet_dropdown_bg', array(
        'default'           => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_tablet_dropdown_bg', array(
        'label'    => __( 'Tablet Dropdown Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_tablet_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_tablet_dropdown_text', array(
        'default'           => '#3a3a3a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_tablet_dropdown_text', array(
        'label'    => __( 'Tablet Dropdown Text', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_tablet_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_tablet_dropdown_hover_bg', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_tablet_dropdown_hover_bg', array(
        'label'    => __( 'Tablet Dropdown Hover Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_tablet_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_tablet_dropdown_hover_text', array(
        'default'           => '#0274be',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_tablet_dropdown_hover_text', array(
        'label'    => __( 'Tablet Dropdown Hover Text', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_tablet_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_tablet_dropdown_border', array(
        'default'           => '#e0e0e0',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_tablet_dropdown_border', array(
        'label'    => __( 'Tablet Dropdown Divider Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_tablet_menu_colors_section',
    ) ) );

    $wp_customize->add_section( 'bungaku_theme_mobile_menu_colors_section', array(
        'title'       => __( 'Mobile Menu Colors', 'bungaku-theme' ),
        'description' => __( 'Applies at 480px wide and below. Also includes the hamburger button and close (X) button, which are shared across tablet and mobile.', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_colors_panel',
        'priority'    => 70,
    ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_menu_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_menu_bg', array(
        'label'    => __( 'Mobile Menu Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_menu_text', array(
        'default'           => '#3a3a3a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_menu_text', array(
        'label'    => __( 'Mobile Menu Text', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_menu_hover_bg', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_menu_hover_bg', array(
        'label'    => __( 'Mobile Menu Hover Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_menu_hover_text', array(
        'default'           => '#0274be',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_menu_hover_text', array(
        'label'    => __( 'Mobile Menu Hover Text', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_dropdown_bg', array(
        'default'           => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_dropdown_bg', array(
        'label'    => __( 'Mobile Dropdown Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_dropdown_text', array(
        'default'           => '#3a3a3a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_dropdown_text', array(
        'label'    => __( 'Mobile Dropdown Text', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_dropdown_hover_bg', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_dropdown_hover_bg', array(
        'label'    => __( 'Mobile Dropdown Hover Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_dropdown_hover_text', array(
        'default'           => '#0274be',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_dropdown_hover_text', array(
        'label'    => __( 'Mobile Dropdown Hover Text', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_dropdown_border', array(
        'default'           => '#e0e0e0',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_dropdown_border', array(
        'label'    => __( 'Mobile Dropdown Divider Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_hamburger_bg', array(
        'default'           => 'transparent',
        'sanitize_callback' => 'bungaku_theme_sanitize_color_transparent',
    ) );
    $wp_customize->add_control( 'bungaku_theme_hamburger_bg', array(
        'label'       => __( 'Hamburger Button Background', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_mobile_menu_colors_section',
        'type'        => 'text',
        'description' => esc_html__( 'Use "transparent" or a hex color like #ff0000', 'bungaku-theme' ),
    ) );

    $wp_customize->add_setting( 'bungaku_theme_hamburger_color', array(
        'default'           => '#3a3a3a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_hamburger_color', array(
        'label'    => __( 'Hamburger Icon Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_hamburger_hover_bg', array(
        'default'           => 'transparent',
        'sanitize_callback' => 'bungaku_theme_sanitize_color_transparent',
    ) );
    $wp_customize->add_control( 'bungaku_theme_hamburger_hover_bg', array(
        'label'       => __( 'Hamburger Button Hover Background', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_mobile_menu_colors_section',
        'type'        => 'text',
        'description' => esc_html__( 'Use "transparent" or a hex color like #ff0000', 'bungaku-theme' ),
    ) );

    $wp_customize->add_setting( 'bungaku_theme_hamburger_hover_color', array(
        'default'           => '#0274be',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_hamburger_hover_color', array(
        'label'    => __( 'Hamburger Icon Hover Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_close_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_close_color', array(
        'label'    => __( 'Mobile Close Button (X) Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_mobile_close_hover_color', array(
        'default'           => '#0274be',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_mobile_close_hover_color', array(
        'label'    => __( 'Mobile Close Button Hover Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_mobile_menu_colors_section',
    ) ) );
    
}
