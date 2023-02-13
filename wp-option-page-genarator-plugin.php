<?php
/*
Plugin Name: Custom Options Page
Description: Adds a custom options page to the Wordpress backend.
Version: 1.0
Author:Rakib Hossain
*/

// Add a custom options page
function custom_options_page() {
    add_options_page(
        'Custom Options Page', // Page Title
        'Custom Options', // Menu Title
        'manage_options', // Capability
        'custom-options', // Menu Slug
        'custom_options_page_content' // Callback function to display page content
    );
}
add_action('admin_menu', 'custom_options_page');

// Display the custom options page content
function custom_options_page_content() {
    echo '<div class="wrap">';
    echo '<h1>Custom Options Page</h1>';
    echo '<form method="post" action="options.php">';
    settings_fields('custom_options');
    do_settings_sections('custom-options');
    submit_button();
    echo '</form>';
    echo '</div>';
}

// Register custom settings
function custom_options_settings() {
    register_setting('custom_options', 'custom_option_1');
    add_settings_section(
        'custom_options_section', // ID
        'Custom Options', // Title
        'custom_options_section_callback', // Callback
        'custom-options' // Page
    );
    add_settings_field(
        'custom_option_1', // ID
        'Custom Option 1', // Title
        'custom_option_1_callback', // Callback
        'custom-options', // Page
        'custom_options_section' // Section
    );
}
add_action('admin_init', 'custom_options_settings');

// Callback for the custom options section
function custom_options_section_callback() {
    echo 'Add custom options below:';
}

// Callback for custom option 1
function custom_option_1_callback() {
    $options = get_option('custom_option_1');
    echo '<input type="text" name="custom_option_1" value="' . esc_attr($options) . '">';
}