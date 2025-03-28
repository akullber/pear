<?php
/**
 * Register the Accordion block
 * 
 */
function register_accordion_block() {
    register_block_type( __DIR__ );
}
add_action('init', 'register_accordion_block');

/**
 * Enqueue editor assets
 * 
 */
function pear_accordion_editor_assets() {
    if ( is_admin() ) {
        wp_enqueue_script( 'pear-accordion-editor' );
    }
}
add_action( 'enqueue_block_editor_assets', 'pear_accordion_editor_assets' );

/**
 * Render the accordion block
 * Scripts and styles are only loaded when block is present
 * 
 * @param array $attributes Block attributes
 * @param string $content Block content
 * @return string Rendered block content
 */
function render_accordion_block($attributes, $content) {
    // Register and enqueue the script only when block is rendered
    wp_register_script(
        'pear-accordion-script',
        get_template_directory_uri() . '/blocks/accordion/script.js',
        array(),
        '1.0.0',
        true
    );
    wp_enqueue_script('pear-accordion-script');

    return $content;
} 