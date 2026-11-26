<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function bungaku_theme_register_layout_panel( $wp_customize ) {
    
    $wp_customize->add_panel( 'bungaku_theme_layout_panel', array(
        'title'       => __( 'Layout Settings', 'bungaku-theme' ),
        'priority'    => 30,
    ) );
    
    $wp_customize->add_section( 'bungaku_theme_sidebar_section', array(
        'title'       => __( 'Sidebar', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_layout_panel',
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_sidebar_position', array(
        'default'           => 'right',
        'sanitize_callback' => 'bungaku_theme_sanitize_sidebar_position',
    ) );
    $wp_customize->add_control( 'bungaku_theme_sidebar_position', array(
        'label'       => __( 'Sidebar Position', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_sidebar_section',
        'type'        => 'radio',
        'choices'     => array(
            'left'  => __( 'Left Sidebar', 'bungaku-theme' ),
            'right' => __( 'Right Sidebar', 'bungaku-theme' ),
        ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_content_width', array(
        'default'           => 75,
        'sanitize_callback' => 'absint',
        'validate_callback' => 'bungaku_theme_validate_layout_widths',
    ) );
    $wp_customize->add_control( 'bungaku_theme_content_width', array(
        'label'       => __( 'Main Content Width (%)', 'bungaku-theme' ),
        'description' => __( 'Recommended: 75% (with sidebar width 22% leaves 3% for gap).', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_sidebar_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 50, 'max' => 80, 'step' => 1 ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_sidebar_width', array(
        'default'           => 22,
        'sanitize_callback' => 'absint',
        'validate_callback' => 'bungaku_theme_validate_layout_widths',
    ) );
    $wp_customize->add_control( 'bungaku_theme_sidebar_width', array(
        'label'       => __( 'Sidebar Width (%)', 'bungaku-theme' ),
        'description' => __( 'Recommended: 22% (together with content width should not exceed 100%).', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_sidebar_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 20, 'max' => 40, 'step' => 1 ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_sidebar_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_sidebar_bg', array(
        'label'    => __( 'Sidebar Background Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_sidebar_section',
    ) ) );
    
    $wp_customize->add_section( 'bungaku_theme_container_section', array(
        'title'       => __( 'Container', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_layout_panel',
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_container_width', array(
        'default'           => 1200,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bungaku_theme_container_width', array(
        'label'       => __( 'Container Width (px)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_container_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 800, 'max' => 1600, 'step' => 10 ),
    ) );
    
    $wp_customize->add_section( 'bungaku_theme_header_section', array(
        'title'       => __( 'Header', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_layout_panel',
    ) );

    // 1.8.0: master switch for the header logo, shown under core's Logo control in Site Identity (see bungaku_theme_custom_logo() in functions.php).
    $wp_customize->add_setting( 'bungaku_theme_show_logo', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_logo', array(
        'label'       => __( 'Show a logo in the header', 'bungaku-theme' ),
        'description' => __( 'Untick to show no logo, whichever one is set above.', 'bungaku-theme' ),
        'section'     => 'title_tagline',
        'priority'    => 9,
        'type'        => 'checkbox',
    ) );
    $custom_logo_control = $wp_customize->get_control( 'custom_logo' );
    if ( $custom_logo_control ) {
        $custom_logo_control->description = __( 'If you do not upload one, the BungAku logo mark is used.', 'bungaku-theme' );
    }

    $wp_customize->add_setting( 'bungaku_theme_logo_position_desktop', array(
        'default'           => get_theme_mod( 'bungaku_theme_logo_position', 'left' ),
        'sanitize_callback' => 'bungaku_theme_sanitize_logo_position',
    ) );
    $wp_customize->add_control( 'bungaku_theme_logo_position_desktop', array(
        'label'       => __( 'Logo Position (Desktop)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'select',
        'choices'     => array(
            'left'   => __( 'Left of Site Title', 'bungaku-theme' ),
            'right'  => __( 'Right of Site Title', 'bungaku-theme' ),
            'top'    => __( 'Above Site Title', 'bungaku-theme' ),
            'bottom' => __( 'Below Site Title', 'bungaku-theme' ),
        ),
    ) );

    $wp_customize->add_setting( 'bungaku_theme_logo_position_tablet', array(
        'default'           => get_theme_mod( 'bungaku_theme_logo_position', 'left' ),
        'sanitize_callback' => 'bungaku_theme_sanitize_logo_position',
    ) );
    $wp_customize->add_control( 'bungaku_theme_logo_position_tablet', array(
        'label'       => __( 'Logo Position (Tablet)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'select',
        'choices'     => array(
            'left'   => __( 'Left of Site Title', 'bungaku-theme' ),
            'right'  => __( 'Right of Site Title', 'bungaku-theme' ),
            'top'    => __( 'Above Site Title', 'bungaku-theme' ),
            'bottom' => __( 'Below Site Title', 'bungaku-theme' ),
        ),
    ) );

    $wp_customize->add_setting( 'bungaku_theme_logo_position_mobile', array(
        'default'           => get_theme_mod( 'bungaku_theme_logo_position', 'left' ),
        'sanitize_callback' => 'bungaku_theme_sanitize_logo_position',
    ) );
    $wp_customize->add_control( 'bungaku_theme_logo_position_mobile', array(
        'label'       => __( 'Logo Position (Mobile)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'select',
        'choices'     => array(
            'left'   => __( 'Left of Site Title', 'bungaku-theme' ),
            'right'  => __( 'Right of Site Title', 'bungaku-theme' ),
            'top'    => __( 'Above Site Title', 'bungaku-theme' ),
            'bottom' => __( 'Below Site Title', 'bungaku-theme' ),
        ),
    ) );

    $wp_customize->add_setting( 'bungaku_theme_title_align_desktop', array(
        'default'           => 'left',
        'sanitize_callback' => 'bungaku_theme_sanitize_text_align',
    ) );
    $wp_customize->add_control( 'bungaku_theme_title_align_desktop', array(
        'label'       => __( 'Title/Description Alignment (Desktop)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'select',
        'choices'     => array(
            'left'   => __( 'Left', 'bungaku-theme' ),
            'center' => __( 'Center', 'bungaku-theme' ),
            'right'  => __( 'Right', 'bungaku-theme' ),
        ),
    ) );

    $wp_customize->add_setting( 'bungaku_theme_title_align_tablet', array(
        'default'           => 'left',
        'sanitize_callback' => 'bungaku_theme_sanitize_text_align',
    ) );
    $wp_customize->add_control( 'bungaku_theme_title_align_tablet', array(
        'label'       => __( 'Title/Description Alignment (Tablet)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'select',
        'choices'     => array(
            'left'   => __( 'Left', 'bungaku-theme' ),
            'center' => __( 'Center', 'bungaku-theme' ),
            'right'  => __( 'Right', 'bungaku-theme' ),
        ),
    ) );

    $wp_customize->add_setting( 'bungaku_theme_title_align_mobile', array(
        'default'           => 'left',
        'sanitize_callback' => 'bungaku_theme_sanitize_text_align',
    ) );
    $wp_customize->add_control( 'bungaku_theme_title_align_mobile', array(
        'label'       => __( 'Title/Description Alignment (Mobile)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'select',
        'choices'     => array(
            'left'   => __( 'Left', 'bungaku-theme' ),
            'center' => __( 'Center', 'bungaku-theme' ),
            'right'  => __( 'Right', 'bungaku-theme' ),
        ),
    ) );

    $wp_customize->add_setting( 'bungaku_theme_tagline_align', array(
        'default'           => 'center',
        'sanitize_callback' => 'bungaku_theme_sanitize_text_align',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bungaku_theme_tagline_align', array(
        'label'       => __( 'Tagline Alignment', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'select',
        'choices'     => array(
            'left'   => __( 'Left', 'bungaku-theme' ),
            'center' => __( 'Center', 'bungaku-theme' ),
            'right'  => __( 'Right', 'bungaku-theme' ),
        ),
    ) );

    $wp_customize->add_setting( 'bungaku_theme_hide_description_tablet', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bungaku_theme_hide_description_tablet', array(
        'label'       => __( 'Hide Site Description on Tablet', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'checkbox',
    ) );

    $wp_customize->add_setting( 'bungaku_theme_hide_description_mobile', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bungaku_theme_hide_description_mobile', array(
        'label'       => __( 'Hide Site Description on Mobile', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'checkbox',
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_logo_max_width_desktop', array(
        'default'           => 200,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bungaku_theme_logo_max_width_desktop', array(
        'label'       => __( 'Logo Max Width - Desktop (>768px)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 50, 'max' => 400, 'step' => 5 ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_logo_max_width_tablet', array(
        'default'           => 150,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bungaku_theme_logo_max_width_tablet', array(
        'label'       => __( 'Logo Max Width - Tablet (481-768px)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 50, 'max' => 300, 'step' => 5 ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_logo_max_width_mobile', array(
        'default'           => 120,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bungaku_theme_logo_max_width_mobile', array(
        'label'       => __( 'Logo Max Width - Mobile (≤480px)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 50, 'max' => 200, 'step' => 5 ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_sticky_header', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_sticky_header', array(
        'label'       => __( 'Enable Sticky Header', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'checkbox',
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_header_padding', array(
        'default'           => 15,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bungaku_theme_header_padding', array(
        'label'       => __( 'Header Padding (px)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 50, 'step' => 1 ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_show_description', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_description', array(
        'label'       => __( 'Show Site Description (Global)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'checkbox',
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_custom_description', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'bungaku_theme_custom_description', array(
        'label'       => __( 'Custom Site Description', 'bungaku-theme' ),
        'description' => __( 'You can use HTML tags like &lt;br&gt; for line breaks.', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_header_section',
        'type'        => 'textarea',
    ) );
    
    $wp_customize->add_section( 'bungaku_theme_menu_section', array(
        'title'       => __( 'Menu Settings', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_layout_panel',
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_menu_padding', array(
        'default'           => 10,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bungaku_theme_menu_padding', array(
        'label'       => __( 'Menu Item Padding (px)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_menu_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 30, 'step' => 1 ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_menu_spacing', array(
        'default'           => 20,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bungaku_theme_menu_spacing', array(
        'label'       => __( 'Menu Item Spacing (px)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_menu_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 50, 'step' => 1 ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_menu_hover_color', array(
        'default'           => '#0274be',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_menu_hover_color', array(
        'label'    => __( 'Main Menu Hover Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_menu_section',
        'settings' => 'bungaku_theme_menu_hover_color',
    ) ) );

    $wp_customize->add_setting( 'bungaku_theme_menu_hover_underline_color', array(
        'default'           => '#0274be',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_menu_hover_underline_color', array(
        'label'    => __( 'Desktop Menu Hover Underline Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_menu_section',
        'settings' => 'bungaku_theme_menu_hover_underline_color',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_show_menu_descriptions', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_menu_descriptions', array(
        'label'       => __( 'Show Menu Descriptions', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_menu_section',
        'type'        => 'checkbox',
    ) );
    
    $wp_customize->add_section( 'bungaku_theme_footer_section', array(
        'title'       => __( 'Footer Settings', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_layout_panel',
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_footer_layout', array(
        'default'           => '4',
        'sanitize_callback' => 'bungaku_theme_sanitize_footer_columns',
    ) );
    $wp_customize->add_control( 'bungaku_theme_footer_layout', array(
        'label'       => __( 'Footer Widget Columns', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_footer_section',
        'type'        => 'select',
        'choices'     => array(
            '1' => __( '1 Column', 'bungaku-theme' ),
            '2' => __( '2 Columns', 'bungaku-theme' ),
            '3' => __( '3 Columns', 'bungaku-theme' ),
            '4' => __( '4 Columns', 'bungaku-theme' ),
        ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_footer_direction', array(
        'default'           => 'horizontal',
        'sanitize_callback' => 'bungaku_theme_sanitize_footer_direction',
    ) );
    $wp_customize->add_control( 'bungaku_theme_footer_direction', array(
        'label'       => __( 'Footer Widgets Layout', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_footer_section',
        'type'        => 'radio',
        'choices'     => array(
            'horizontal' => __( 'Horizontal (Row)', 'bungaku-theme' ),
            'vertical'   => __( 'Vertical (Stack)', 'bungaku-theme' ),
        ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_footer_bg', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_footer_bg', array(
        'label'    => __( 'Footer Background', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_footer_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_footer_padding', array(
        'default'           => 40,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bungaku_theme_footer_padding', array(
        'label'       => __( 'Footer Padding (px)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_footer_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 100, 'step' => 5 ),
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_copyright_text', array(
        'default'           => '&copy; ' . date_i18n('Y') . ' ' . get_bloginfo('name') . '. All rights reserved.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'bungaku_theme_copyright_text', array(
        'label'       => __( 'Copyright Text', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_footer_section',
        'type'        => 'textarea',
    ) );
    
    $wp_customize->add_setting( 'bungaku_theme_copyright_color', array(
        'default'           => '#666666',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bungaku_theme_copyright_color', array(
        'label'    => __( 'Copyright Text Color', 'bungaku-theme' ),
        'section'  => 'bungaku_theme_footer_section',
    ) ) );
    
    $wp_customize->add_setting( 'bungaku_theme_show_footer_menu', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_footer_menu', array(
        'label'       => __( 'Show Footer Menu', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_footer_section',
        'type'        => 'checkbox',
    ) );
    
}
