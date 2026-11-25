<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function bungaku_theme_register_typography_panel( $wp_customize ) {
    $wp_customize->add_panel( 'bungaku_theme_typography_panel', array(
        'title'       => __( 'Typography', 'bungaku-theme' ),
        'priority'    => 40,
        'description' => __( 'Customize fonts for different devices. Desktop > 768px, Tablet: 481-768px, Mobile: ≤ 480px', 'bungaku-theme' ),
    ) );
    $wp_customize->add_section( 'bungaku_theme_font_family_section', array(
        'title'       => __( 'Font Family', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_typography_panel',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_body_font_family', array(
        'default'           => 'default',
        'sanitize_callback' => 'bungaku_theme_sanitize_body_font_family',
    ) );
    $wp_customize->add_control( 'bungaku_theme_body_font_family', array(
        'label'       => __( 'Body Font Family', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_font_family_section',
        'type'        => 'select',
        'choices'     => array(
            'default'      => __( 'System Default', 'bungaku-theme' ),
            'Arial, sans-serif' => __( 'Arial', 'bungaku-theme' ),
            'Helvetica, sans-serif' => __( 'Helvetica', 'bungaku-theme' ),
            'Verdana, sans-serif' => __( 'Verdana', 'bungaku-theme' ),
            'Tahoma, sans-serif' => __( 'Tahoma', 'bungaku-theme' ),
            '"Trebuchet MS", sans-serif' => __( 'Trebuchet MS', 'bungaku-theme' ),
            'Georgia, serif' => __( 'Georgia', 'bungaku-theme' ),
            '"Times New Roman", serif' => __( 'Times New Roman', 'bungaku-theme' ),
            'Palatino, serif' => __( 'Palatino', 'bungaku-theme' ),
            '"Courier New", monospace' => __( 'Courier New', 'bungaku-theme' ),
            '"Comic Sans MS", cursive' => __( 'Comic Sans', 'bungaku-theme' ),
        ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_heading_font_family', array(
        'default'           => 'default',
        'sanitize_callback' => 'bungaku_theme_sanitize_heading_font_family',
    ) );
    $wp_customize->add_control( 'bungaku_theme_heading_font_family', array(
        'label'       => __( 'Heading Font Family', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_font_family_section',
        'type'        => 'select',
        'choices'     => array(
            'default'      => __( 'Same as Body', 'bungaku-theme' ),
            'Arial, sans-serif' => __( 'Arial', 'bungaku-theme' ),
            'Helvetica, sans-serif' => __( 'Helvetica', 'bungaku-theme' ),
            'Verdana, sans-serif' => __( 'Verdana', 'bungaku-theme' ),
            'Tahoma, sans-serif' => __( 'Tahoma', 'bungaku-theme' ),
            '"Trebuchet MS", sans-serif' => __( 'Trebuchet MS', 'bungaku-theme' ),
            'Georgia, serif' => __( 'Georgia', 'bungaku-theme' ),
            '"Times New Roman", serif' => __( 'Times New Roman', 'bungaku-theme' ),
            'Palatino, serif' => __( 'Palatino', 'bungaku-theme' ),
            '"Courier New", monospace' => __( 'Courier New', 'bungaku-theme' ),
            'Impact, sans-serif' => __( 'Impact', 'bungaku-theme' ),
        ),
    ) );
    $wp_customize->add_section( 'bungaku_theme_font_size_desktop_section', array(
        'title'       => __( 'Desktop Sizes (>768px)', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_typography_panel',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_body_font_size_desktop', array( 'default' => 16, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bungaku_theme_body_font_size_desktop', array(
        'label' => __( 'Body Font Size (px)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_desktop_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 12, 'max' => 24, 'step' => 1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_site_title_size_desktop', array( 'default' => '1.8', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_site_title_size_desktop', array(
        'label' => __( 'Site Title Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_desktop_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 1, 'max' => 4, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_tagline_size_desktop', array( 'default' => '1', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_tagline_size_desktop', array(
        'label' => __( 'Tagline Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_desktop_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.5, 'max' => 2, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_description_size_desktop', array( 'default' => '0.9', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_description_size_desktop', array(
        'label' => __( 'Site Description Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_desktop_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.5, 'max' => 2, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_heading_size_desktop', array( 'default' => '2', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_heading_size_desktop', array(
        'label' => __( 'Heading (H1) Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_desktop_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 1, 'max' => 4, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_menu_size_desktop', array( 'default' => '1', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_menu_size_desktop', array(
        'label' => __( 'Menu Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_desktop_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.8, 'max' => 2, 'step' => 0.1 ),
    ) );
    $wp_customize->add_section( 'bungaku_theme_font_size_tablet_section', array(
        'title' => __( 'Tablet Sizes (481-768px)', 'bungaku-theme' ), 'panel' => 'bungaku_theme_typography_panel',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_body_font_size_tablet', array( 'default' => 15, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bungaku_theme_body_font_size_tablet', array(
        'label' => __( 'Body Font Size (px)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_tablet_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 12, 'max' => 22, 'step' => 1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_site_title_size_tablet', array( 'default' => '1.5', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_site_title_size_tablet', array(
        'label' => __( 'Site Title Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_tablet_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 1, 'max' => 3, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_tagline_size_tablet', array( 'default' => '0.9', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_tagline_size_tablet', array(
        'label' => __( 'Tagline Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_tablet_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.5, 'max' => 1.5, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_description_size_tablet', array( 'default' => '0.85', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_description_size_tablet', array(
        'label' => __( 'Site Description Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_tablet_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.5, 'max' => 1.5, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_heading_size_tablet', array( 'default' => '1.7', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_heading_size_tablet', array(
        'label' => __( 'Heading (H1) Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_tablet_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 1, 'max' => 3, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_menu_size_tablet', array( 'default' => '0.95', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_menu_size_tablet', array(
        'label' => __( 'Menu Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_tablet_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.8, 'max' => 1.8, 'step' => 0.1 ),
    ) );
    $wp_customize->add_section( 'bungaku_theme_font_size_mobile_section', array(
        'title' => __( 'Mobile Sizes (≤480px)', 'bungaku-theme' ), 'panel' => 'bungaku_theme_typography_panel',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_body_font_size_mobile', array( 'default' => 14, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bungaku_theme_body_font_size_mobile', array(
        'label' => __( 'Body Font Size (px)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_mobile_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 12, 'max' => 20, 'step' => 1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_site_title_size_mobile', array( 'default' => '1.3', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_site_title_size_mobile', array(
        'label' => __( 'Site Title Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_mobile_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.5, 'max' => 2.5, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_tagline_size_mobile', array( 'default' => '0.85', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_tagline_size_mobile', array(
        'label' => __( 'Tagline Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_mobile_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.5, 'max' => 1.2, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_description_size_mobile', array( 'default' => '0.8', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_description_size_mobile', array(
        'label' => __( 'Site Description Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_mobile_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.5, 'max' => 1.2, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_heading_size_mobile', array( 'default' => '1.5', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_heading_size_mobile', array(
        'label' => __( 'Heading (H1) Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_mobile_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 1, 'max' => 2.5, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_menu_size_mobile', array( 'default' => '0.9', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_menu_size_mobile', array(
        'label' => __( 'Menu Font Size (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_mobile_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.8, 'max' => 1.5, 'step' => 0.1 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_body_line_height', array( 'default' => '1.6', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_body_line_height', array(
        'label' => __( 'Body Line Height (all devices)', 'bungaku-theme' ), 'section' => 'bungaku_theme_font_size_mobile_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 1, 'max' => 2.5, 'step' => 0.1 ),
    ) );
    $wp_customize->add_section( 'bungaku_theme_submenu_section', array(
        'title' => __( 'Submenu & Hamburger', 'bungaku-theme' ), 'panel' => 'bungaku_theme_typography_panel',
        'description' => __( 'Control submenu font sizes (separate from top‑level menu) and hamburger button size on mobile/tablet.', 'bungaku-theme' ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_submenu_size_desktop', array( 'default' => '0.95', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_submenu_size_desktop', array(
        'label' => __( 'Submenu Font Size - Desktop (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_submenu_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.7, 'max' => 1.5, 'step' => 0.05 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_submenu_size_tablet', array( 'default' => '0.9', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_submenu_size_tablet', array(
        'label' => __( 'Submenu Font Size - Tablet (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_submenu_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.7, 'max' => 1.5, 'step' => 0.05 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_submenu_size_mobile', array( 'default' => '0.85', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_submenu_size_mobile', array(
        'label' => __( 'Submenu Font Size - Mobile (rem)', 'bungaku-theme' ), 'section' => 'bungaku_theme_submenu_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.7, 'max' => 1.5, 'step' => 0.05 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_hamburger_width', array( 'default' => 40, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bungaku_theme_hamburger_width', array(
        'label' => __( 'Hamburger Button Width (px) – Mobile/Tablet', 'bungaku-theme' ), 'section' => 'bungaku_theme_submenu_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 30, 'max' => 80, 'step' => 2 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_hamburger_height', array( 'default' => 40, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bungaku_theme_hamburger_height', array(
        'label' => __( 'Hamburger Button Height (px) – Mobile/Tablet', 'bungaku-theme' ), 'section' => 'bungaku_theme_submenu_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 30, 'max' => 80, 'step' => 2 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_hamburger_font_size', array( 'default' => '1.2', 'sanitize_callback' => 'bungaku_theme_sanitize_float' ) );
    $wp_customize->add_control( 'bungaku_theme_hamburger_font_size', array(
        'label' => __( 'Hamburger Icon Font Size (rem) – Mobile/Tablet', 'bungaku-theme' ), 'section' => 'bungaku_theme_submenu_section',
        'type' => 'number', 'input_attrs' => array( 'min' => 0.8, 'max' => 2.5, 'step' => 0.1 ),
    ) );
}
