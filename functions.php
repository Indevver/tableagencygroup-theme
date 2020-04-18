<?php
add_action( 'wp_enqueue_scripts', 'tag_enqueue_styles' );
function tag_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [$parent_style], wp_get_theme()->get('Version'));
    wp_enqueue_style( 'global-styles', get_stylesheet_directory_uri() . '/assets/css/min/master.min.css', [$parent_style], '1.0.1');
    wp_enqueue_style( 'typekit', 'https://use.typekit.net/ena6hfe.css' );

}


function tag_setup() {
	// Add support for editor styles.
    add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( '/assets/css/min/master.min.css' );
	add_editor_style( 'https://use.typekit.net/ena6hfe.css' );
}
add_action( 'after_setup_theme', 'tag_setup' );
