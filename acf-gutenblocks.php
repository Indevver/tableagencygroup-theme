<?php

require('vendor/autoload.php');

use StoutLogic\AcfBuilder\FieldsBuilder;

function register_acf_block_types() {
	acf_register_block_type( [
	'name'              => 'contentslider',
	'title'             => __('Content Slider'),
	'description'       => __('A custom content slider block.'),
	'render_template'   => 'template-parts/blocks/content-slider/content-slider.php',
	'category'          => 'formatting',
	'icon'              => 'slides',
	'keywords'          => [ 'slider', 'swiper', 'carousel' ],
	] );
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
	add_action('acf/init', 'register_acf_block_types');
}

$contentslider = new FieldsBuilder('content_slider');

$contentslider->addRepeater('slides', ['min' => 1, 'layout' => 'block'])
	->addText('session_title')
	->addImage('image')
	->addRepeater('panelists', ['min' => 1, 'layout' => 'block'])
		->addImage('headshot')
		->addLink('link_to_bio')
		->addText('name')
		->addText('organization')
		->endRepeater()
	->endRepeater()
	->setLocation('block', '==', 'acf/contentslider');

add_action('acf/init', function() use ($contentslider) {
	acf_add_local_field_group($contentslider->build());
});
