<?php

include('acf-gutenblocks.php');

add_action( 'wp_enqueue_scripts', 'tag_enqueue_styles' );
function tag_enqueue_styles() {

    $version = '1.1.2';

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [$parent_style], wp_get_theme()->get('Version'));
    wp_enqueue_style( 'global-styles', get_stylesheet_directory_uri() . '/assets/css/min/master.min.css', [$parent_style], $version);
    // wp_enqueue_style( 'typekit', 'https://use.typekit.net/ena6hfe.css' ); // Jeremy's
    wp_enqueue_style( 'typekit', 'https://use.typekit.net/eqz5ubu.css' ); // Brian's

    wp_enqueue_script( 'swiper', get_stylesheet_directory_uri() . '/assets/js/swiper.min.js', array( 'jquery' ), $version );
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/assets/js/tag-scripts.js', array( 'jquery', 'swiper' ), $version );
}


function tag_setup() {
	// Add support for editor styles.
    add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( '/assets/css/min/editor-styles.min.css' );
}
add_action( 'after_setup_theme', 'tag_setup' );


function custom_redirects() {

    if ( is_front_page() ) {
        wp_redirect( home_url( '/rise-up/' ) );
        die;
    }

}
add_action( 'template_redirect', 'custom_redirects' );
