<?php

function slide_gallery_layout() {
	$gal_type 			= get_field('gallery_type');
	$gal_details 		= get_field('gallery_details');
	$col_count 			= get_field('image_column');
	$thumbnail 			= get_field('image_thumbnail');
	$show_title 		= get_field('display_title');
	$show_zoom 			= get_field('image_zoom');
	$gal_id 			= get_the_id();
	$dots 				= ( get_field('slick_dots') ? 'true' : 'false' );
	$infinite 			= ( get_field('slick_infinite') ? 'true' : 'false' );
	$fade 				= ( get_field('slick_fade') ? 'true' : 'false' );
	$pause 				= ( get_field('slick_pauseOnHover') ? 'true' : 'false' );
	$auto 				= ( get_field('slick_autoplay') ? 'true' : 'false' );
	$adaptive 			= ( get_field('slick_adaptiveHeight') ? 'true' : 'false' );
	$center 			= ( get_field('slick_centerMode') ? 'true' : 'false' );
	$slidesToShow 		= ( get_field('slick_slidesToShow') == "" ? 1 : (int)get_field('slick_slidesToShow') );
	$slidesToScroll 	= ( get_field('slick_slidesToScroll') == "" ? 1 : (int)get_field('slick_slidesToScroll') );
	$speed 				= ( get_field('slick_speed') == "" ? 500 : (int)get_field('slick_speed') );
	$autoplaySpeed 		= ( get_field('slick_autoplaySpeed') == "" ? 5000 : (int)get_field('slick_autoplaySpeed') );

	$fisrt_responsive 			= get_field('slick_first_responsive');
	$fisrt_breakpoint			= ( isset($fisrt_responsive['slick_first_breakpoint']) == "" ? 1024 : (int)$fisrt_responsive['slick_first_breakpoint'] );
	$fisrt_slidesToShow			= ( isset($fisrt_responsive['slick_first_slidesToShow']) == "" ? 1 : (int)$fisrt_responsive['slick_first_slidesToShow'] );
	$fisrt_slidesToScroll		= ( isset($fisrt_responsive['slick_first_slidesToScroll']) == "" ? 1 : (int)$fisrt_responsive['slick_first_slidesToScroll'] );

	$second_responsive 			= get_field('slick_second_responsive');
	$second_breakpoint			= ( isset($second_responsive['slick_second_breakpoint']) == "" ? 768 : (int)$second_responsive['slick_second_breakpoint'] );
	$second_slidesToShow		= ( isset($second_responsive['slick_second_slidesToShow']) == "" ? 1 : (int)$second_responsive['slick_second_slidesToShow'] );
	$second_slidesToScroll		= ( isset($second_responsive['slick_second_slidesToScroll']) == "" ? 1 : (int)$second_responsive['slick_second_slidesToScroll'] );

	$third_responsive 			= get_field('slick_third_responsive');
	$third_breakpoint			= ( isset($third_responsive['slick_third_breakpoint']) == "" ? 480 : (int)$third_responsive['slick_third_breakpoint'] );
	$third_slidesToShow			= ( isset($third_responsive['slick_third_slidesToShow']) == "" ? 1 : (int)$third_responsive['slick_third_slidesToShow'] );
	$third_slidesToScroll		= ( isset($third_responsive['slick_third_slidesToScroll']) == "" ? 1 : (int)$third_responsive['slick_third_slidesToScroll'] );

?>
	<?php if ( $gal_type == 'slide' ): ?>
		<div class="slmp-gallery slmp-slide-gallery slmp-relative" gallery-id="<?php echo $gal_id ?>" gallery-type="<?php echo $gal_type ?>">
			<?php if ( $gal_details['gallery_title'] ): ?>
				<h2><?php echo $gal_details['gallery_title'] ?></h2>
			<?php endif ?>
			<?php if ( $gal_details['gallery_description'] ): ?>
				<p><?php echo $gal_details['gallery_description'] ?></p>
			<?php endif ?>
			<?php if ( $gal_details['slide_gallery_images'] ): ?>
				<div class="slmp-row slmp-slide-image-items slmp-relative" data-dots="<?php echo $dots  ?>" data-infinite="<?php echo $infinite ?>" data-fade="<?php echo $fade ?>" data-pause="<?php echo $pause ?>" data-autoplay="<?php echo $auto ?>" data-adaptive="<?php echo $adaptive ?>" data-center="<?php echo $center ?>" data-slides-show="<?php echo $slidesToShow ?>" data-slides-scroll="<?php echo $slidesToScroll ?>" data-speed="<?php echo $speed ?>" data-autoplay-speed="<?php echo $autoplaySpeed ?>" data-first-breakpoint="<?php echo $fisrt_breakpoint ?>" data-first-show="<?php echo $fisrt_slidesToShow ?>" data-first-scroll="<?php echo $fisrt_slidesToScroll ?>" data-second-breakpoint="<?php echo $second_breakpoint ?>"  data-second-show="<?php echo $second_slidesToShow ?>" data-second-scroll="<?php echo $second_slidesToScroll ?>" data-third-breakpoint="<?php echo $third_breakpoint ?>" data-third-show="<?php echo $third_slidesToShow ?>" data-third-scroll="<?php echo $third_slidesToScroll ?>">
					<div class="slmp-display-image slmp-slide-display-image slmp-relative">
						<?php foreach ( $gal_details['slide_gallery_images'] as $slide_image ) :
							$image = $thumbnail == 'full' ? $slide_image['url'] : ( $thumbnail == 'slmp_thumbnail' ? $slide_image['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $slide_image['sizes']['thumbnail'] : $slide_image['sizes']['slmp-gallery-thumbnail'] ) );
						?>
							<div class="slmp-image-item <?php echo ( $show_zoom ? 'zoom-icon-hover' : 'no-zoom-icon' ) ?> slmp-text-center slmp-relative" data-id="slmp-slide-item-<?php echo $slide_image['id'] ?>-<?php echo $gal_id ?>">
								<div class="slmp-image slmp-relative">
									<div class="slmp-slide-image slmp-relative">
										<img src="<?php echo $image ?>" alt="<?php echo $slide_image['alt'] ?>" title="<?php echo $slide_image['title'] ?>">
										<?php if ( $show_title == true ): ?>
											<div class="slmp-image-label slmp-text-center"><?php echo $slide_image['title'] ?></div>
										<?php endif ?>
										<?php if ( $show_zoom == true ): ?>
											<div class="slmp-image-hover-icon"></div>
										<?php endif ?>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
					<div class="slmp-slide-left-arrow"></div>
					<div class="slmp-slide-right-arrow"></div>
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>
<?php }