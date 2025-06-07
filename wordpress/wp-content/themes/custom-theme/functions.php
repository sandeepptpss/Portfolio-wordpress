<?php

// Enable featured image support
add_theme_support('post-thumbnails');
add_theme_support('custom-header');

register_nav_menus([
    'left_side_menu' => __('Left Side Menu'),
    'right_side_menu' => __('Right Side Menu'), 
    // 'side_menu' => __('Side Menu'), 
]);

function mytheme_customize_register( $wp_customize ) {

    // Section
    $wp_customize->add_section('custom_content_section', array(
        'title' => __('Banner', 'mytheme'),
        'priority' => 30,
    ));

    // Image
    $wp_customize->add_setting('custom_image_setting', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_image_setting', array(
        'label' => __('Upload an Image', 'mytheme'),
        'section' => 'custom_content_section',
        'settings' => 'custom_image_setting',
    )));

    // Text (Single Line)
    $wp_customize->add_setting('custom_text_setting', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('custom_text_setting', array(
        'label' => __('Heading', 'mytheme'),
        'section' => 'custom_content_section',
        'type' => 'text',
    ));

    // Link
    $wp_customize->add_setting('custom_link_setting', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('custom_link_setting', array(
        'label' => __('Enter Link URL', 'mytheme'),
        'section' => 'custom_content_section',
        'type' => 'url',
    ));

    // Textarea
    $wp_customize->add_setting('custom_textarea_setting', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('custom_textarea_setting', array(
        'label' => __('Text', 'mytheme'),
        'section' => 'custom_content_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'mytheme_customize_register');

?>
