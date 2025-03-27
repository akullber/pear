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

/**
 * Enqueues editor styles.
 *
 * @since 1.0.0
 */
function pear_theme_enqueue_editor_styles() {
  wp_enqueue_style('pear-theme-editor-style', get_template_directory_uri() . '/build/editor.css');
}
add_action('enqueue_block_editor_assets', 'pear_theme_enqueue_editor_styles');

// Registers custom block styles.
if ( ! function_exists( 'pear_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	function pear_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'pear' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
            list-style: none;
            padding-left: 0;
        }
        
				ul.is-style-checkmark-list {
            list-style: none;
            padding-left: 0;
        }
        
        ul.is-style-checkmark-list li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 10px;
        }
        
        ul.is-style-checkmark-list li:before {
            content: "";
            position: absolute;
            left: 0;
            top: 1px;
            width: 24px;
            height: 24px;
            background-color: #4D5A5E;
            border-radius: 50%;
        }
        
        ul.is-style-checkmark-list li:after {
            content: "✓";
            position: absolute;
            left: 2px;
            top: -5px;
            color: white;
            font-size: 24px;
        }',
			)
		);

    register_block_style( 
			array( 'core/paragraph', 'core/heading' ), 
			array( 
				'name'         => 'kicker', 
				'label'        => __( 'Kicker', 'pear' ), 
				'inline_style' => '.is-style-kicker { 
					border-radius: 10000px; 
					background: #F2F2F2;
          text-transform: uppercase;
          font-size: .75rem;
          display: inline-block;
          padding: .5rem 1rem;
          font-weight: 800;
          color: #4D5A5E;
				}',
			) 
		);

    register_block_style(
      'core/media-text',
      array(
          'name'         => 'rounded-image',
          'label'        => 'Rounded Image',
          'inline_style' => '.is-style-rounded-image .wp-block-media-text__media img {
              border-radius: 1.5rem;
              overflow: hidden;
          }',
      )
  );
	}
endif;
add_action( 'init', 'pear_block_styles' );
