<?php

/**
 * Content Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'contentslider-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'contentslider';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$slides = array_map( function($a) {
	$filter = ['url' => 'url', 'alt' => 'alt', 'sizes' => 'sizes'];
	$a['image'] = array_intersect_key($a['image'], $filter);
	return $a;
}, get_field('slides'))
?>

<div id="<?= $id ?>" class="<?= $className ?>">
	<?php foreach($slides as $slide) : ?>
		<h3>
			<?= $slide['session_title'] ?>
        </h3>
        <div class="columns">
            <div class="col">
                <img src="<?= $slide['image']['sizes']['medium'] ?>" alt="<?= $slide['image']['alt'] ?>">
            </div>
            <div class="col panelists">
                <?php if ($slide['panelists']) : ?>
		            <?php foreach($slide['panelists'] as $panelist) : ?>
                        <a class="panelist" href="<?= $panelist['link_to_bio']['url'] ?? '' ?>" target="<?= $panelist['link_to_bio']['target'] ?? '' ?>">
                            <img class="panelist-headshot" src="<?= $panelist['headshot']['sizes']['medium'] ?>" alt="<?= $panelist['headshot']['alt'] ?>">
	                        <div class="panelist-name">
		                        <?= $panelist['name'] ?>
                            </div>
                            <div class="panelist-organization">
	                            <?= $panelist['organization'] ?>
                            </div>
                        </a>
		            <?php endforeach ?>
	            <?php endif ?></div>
            </div>
	<?php endforeach ?>
</div>
