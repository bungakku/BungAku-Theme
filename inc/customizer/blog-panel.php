<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function bungaku_theme_register_blog_panel( $wp_customize ) {
    $wp_customize->add_panel( 'bungaku_theme_blog_panel', array(
        'title'       => __( 'Blog Settings', 'bungaku-theme' ),
        'priority'    => 60,
    ) );
    $wp_customize->add_section( 'bungaku_theme_blog_layout_section', array(
        'title'       => __( 'Blog Layout', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_blog_panel',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_blog_layout', array(
        'default'           => 'classic',
        'sanitize_callback' => 'bungaku_theme_sanitize_blog_layout',
    ) );
    $wp_customize->add_control( 'bungaku_theme_blog_layout', array(
        'label'       => __( 'Blog Layout Style', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_blog_layout_section',
        'type'        => 'radio',
        'choices'     => array(
            'classic' => __( 'Classic (Full Width)', 'bungaku-theme' ),
            'grid'    => __( 'Grid Layout', 'bungaku-theme' ),
            'list'    => __( 'List Layout', 'bungaku-theme' ),
        ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_grid_columns', array(
        'default'           => '2',
        'sanitize_callback' => 'bungaku_theme_sanitize_grid_columns',
    ) );
    $wp_customize->add_control( 'bungaku_theme_grid_columns', array(
        'label'       => __( 'Grid Columns', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_blog_layout_section',
        'type'        => 'select',
        'choices'     => array(
            '2' => __( '2 Columns', 'bungaku-theme' ),
            '3' => __( '3 Columns', 'bungaku-theme' ),
            '4' => __( '4 Columns', 'bungaku-theme' ),
        ),
    ) );
    $wp_customize->add_section( 'bungaku_theme_post_elements_section', array(
        'title'       => __( 'Post Elements', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_blog_panel',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_show_featured_image', array(
        'default'           => 'show',
        'sanitize_callback' => 'bungaku_theme_sanitize_show_hide',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_featured_image', array(
        'label'       => __( 'Featured Image', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'radio',
        'choices'     => array(
            'show' => __( 'Show', 'bungaku-theme' ),
            'hide' => __( 'Hide', 'bungaku-theme' ),
        ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_featured_image_size', array(
        'default'           => 'large',
        'sanitize_callback' => 'bungaku_theme_sanitize_image_size',
    ) );
    $wp_customize->add_control( 'bungaku_theme_featured_image_size', array(
        'label'       => __( 'Featured Image Size', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'select',
        'choices'     => array(
            'thumbnail' => __( 'Thumbnail', 'bungaku-theme' ),
            'medium'    => __( 'Medium', 'bungaku-theme' ),
            'large'     => __( 'Large', 'bungaku-theme' ),
            'full'      => __( 'Full Size', 'bungaku-theme' ),
        ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_show_post_meta', array(
        'default'           => 'show',
        'sanitize_callback' => 'bungaku_theme_sanitize_post_meta',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_post_meta', array(
        'label'       => __( 'Post Meta', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'radio',
        'choices'     => array(
            'show'   => __( 'Show All Meta', 'bungaku-theme' ),
            'hide'   => __( 'Hide All Meta', 'bungaku-theme' ),
            'custom' => __( 'Custom Selection', 'bungaku-theme' ),
        ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_show_post_date', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_post_date', array(
        'label'       => __( 'Show Post Date', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'checkbox',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_show_post_author', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_post_author', array(
        'label'       => __( 'Show Post Author', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'checkbox',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_show_post_comments', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_post_comments', array(
        'label'       => __( 'Show Comment Count', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'checkbox',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_show_post_categories', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_post_categories', array(
        'label'       => __( 'Show Post Categories', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'checkbox',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_content_display', array(
        'default'           => 'excerpt',
        'sanitize_callback' => 'bungaku_theme_sanitize_content_display',
    ) );
    $wp_customize->add_control( 'bungaku_theme_content_display', array(
        'label'       => __( 'Content Display', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'radio',
        'choices'     => array(
            'excerpt' => __( 'Excerpt', 'bungaku-theme' ),
            'full'    => __( 'Full Content', 'bungaku-theme' ),
            'none'    => __( 'No Content (Title Only)', 'bungaku-theme' ),
        ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_excerpt_length', array(
        'default'           => 30,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bungaku_theme_excerpt_length', array(
        'label'       => __( 'Excerpt Length (words)', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 10, 'max' => 100, 'step' => 5 ),
    ) );
    $wp_customize->add_setting( 'bungaku_theme_show_read_more', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_read_more', array(
        'label'       => __( 'Show Read More Button', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'checkbox',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_read_more_text', array(
        'default'           => 'Read More',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bungaku_theme_read_more_text', array(
        'label'       => __( 'Read More Button Text', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_post_elements_section',
        'type'        => 'text',
    ) );
    $wp_customize->add_section( 'bungaku_theme_single_post_section', array(
        'title'       => __( 'Single Post', 'bungaku-theme' ),
        'panel'       => 'bungaku_theme_blog_panel',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_show_author_bio', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_author_bio', array(
        'label'       => __( 'Show Author Bio on Single Posts', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_single_post_section',
        'type'        => 'checkbox',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_show_related_posts', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'bungaku_theme_show_related_posts', array(
        'label'       => __( 'Show Related Posts', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_single_post_section',
        'type'        => 'checkbox',
    ) );
    $wp_customize->add_setting( 'bungaku_theme_related_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bungaku_theme_related_count', array(
        'label'       => __( 'Number of Related Posts', 'bungaku-theme' ),
        'section'     => 'bungaku_theme_single_post_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 6, 'step' => 1 ),
    ) );
}
