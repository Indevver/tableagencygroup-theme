<?php

include('acf-gutenblocks.php');

add_action( 'wp_enqueue_scripts', 'tag_enqueue_styles' );
function tag_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [$parent_style], wp_get_theme()->get('Version'));
    wp_enqueue_style( 'typekit', 'https://use.typekit.net/ena6hfe.css' );

}
