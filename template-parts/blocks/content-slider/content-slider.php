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

<div id="<?= $id ?>" class="wp-block-coblocks-row alignwide <?= $className ?>">
	<!-- If we need navigation buttons -->
	<div class="swiper-container">
	    <!-- Additional required wrapper -->
	    <div class="swiper-wrapper">
	        <!-- Slides -->
			<?php foreach($slides as $slide) : ?>
				<div class="swiper-slide">
					<div class="row tag-title__line">
						<div class="columns">
							<h3>
								<?= $slide['session_title'] ?>
					        </h3>
						</div>
					</div>
					<div class="row">
						<div class="columns small-12 large-5 show-for-large">
							<img src="<?= $slide['image']['sizes']['medium'] ?>" alt="<?= $slide['image']['alt'] ?>">
						</div>
						<div class="columns small-12 large-6 large-offset-1 panelists">
							<?php if ($slide['panelists']) :
								$parallax = -100;
								?>
								<div class="row small-up-2 medium-up-3">
						            <?php foreach($slide['panelists'] as $panelist) : ?>
										<div class="columns text-center">
											<a class="panelist" href="<?= $panelist['link_to_bio']['url'] ?? '' ?>" target="<?= $panelist['link_to_bio']['target'] ?? '' ?>" data-swiper-parallax="<?php echo $parallax; ?>" data-swiper-parallax-duration="500">
					                            <img class="panelist-headshot" src="<?= $panelist['headshot']['sizes']['medium'] ?>" alt="<?= $panelist['headshot']['alt'] ?>">
						                        <div class="panelist-name">
							                        <?= $panelist['name'] ?>
					                            </div>
					                            <div class="panelist-organization">
						                            <?= $panelist['organization'] ?>
					                            </div>
					                        </a>
										</div>
						            <?php
									$parallax = $parallax - 50;
									endforeach ?>
								</div>
				            <?php endif ?>
						</div>
					</div>
				</div>
			<?php endforeach ?>
	    </div>
	</div>
	<div class="tag-swiper-pagination swiper-pagination"></div>
	<div class="tag-swiper-prev swiper-button-prev"></div>
	<div class="tag-swiper-next swiper-button-next"></div>
	<?php /* foreach($slides as $slide) : ?>
		<div class="swiper-slide">
			<div class="row">
				<div class="columns">
					<h3>
						<?= $slide['session_title'] ?>
			        </h3>
				</div>
			</div>
			<div class="row">
				<div class="columns small-12 medium-6 show-for-medium">
					<img src="<?= $slide['image']['sizes']['medium'] ?>" alt="<?= $slide['image']['alt'] ?>">
				</div>
				<div class="columns small-12 medium-6">
					<?php if ($slide['panelists']) : ?>
						<div class="row small-up-2 medium-up-3">
				            <?php foreach($slide['panelists'] as $panelist) : ?>
								<div class="columns">
									<a class="panelist" href="<?= $panelist['link_to_bio']['url'] ?? '' ?>" target="<?= $panelist['link_to_bio']['target'] ?? '' ?>">
			                            <img class="panelist-headshot" src="<?= $panelist['headshot']['sizes']['medium'] ?>" alt="<?= $panelist['headshot']['alt'] ?>">
				                        <div class="panelist-name">
					                        <?= $panelist['name'] ?>
			                            </div>
			                            <div class="panelist-organization">
				                            <?= $panelist['organization'] ?>
			                            </div>
			                        </a>
								</div>
				            <?php endforeach ?>
						</div>
		            <?php endif ?>
				</div>
			</div>
		</div>
	<?php endforeach */ ?>
</div>
