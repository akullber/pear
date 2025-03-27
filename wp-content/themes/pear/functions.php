<?php
/**
 * Pear functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pear
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since 1.0.0
 */
function pear_theme_setup() {
  add_theme_support('block-template');
}
add_action('after_setup_theme', 'pear_theme_setup');

/**
 * Enqueues theme styles for the front end.
 *
 * @since 1.0.0
 */
function pear_theme_enqueue() {
  wp_enqueue_style('pear-theme-style', get_template_directory_uri() . '/build/style-index.css');
}
add_action('wp_enqueue_scripts', 'pear_theme_enqueue');

/**
 * Enqueues block editor assets.
 *
 * @since 1.0.0
 */
function pear_theme_enqueue_blocks() {
  wp_enqueue_script('pear-theme-blocks', get_template_directory_uri() . '/build/index.js', ['wp-blocks', 'wp-dom'], '1.0', true);
}
add_action('enqueue_block_editor_assets', 'pear_theme_enqueue_blocks');
