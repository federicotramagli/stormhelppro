<?php

function masonry_gallery_layout() {
	$gal_type 			= get_field('gallery_type');
	$gal_details 		= get_field('gallery_details');
	$col_count 			= get_field('image_column');
	$thumbnail 			= get_field('image_thumbnail');
	$show_title 		= get_field('display_title');
	$show_zoom 			= get_field('image_zoom');
	$gal_id 			= get_the_id();
?>
	<?php if ( $gal_type == 'masonry' ): ?>
		<div class="slmp-gallery slmp-masonry-gallery slmp-relative" gallery-id="<?php echo $gal_id ?>" gallery-type="<?php echo $gal_type ?>">
			<?php if ( $gal_details['gallery_title'] ): ?>
				<h2><?php echo $gal_details['gallery_title'] ?></h2>
			<?php endif ?>
			<?php if ( $gal_details['gallery_description'] ): ?>
				<p><?php echo $gal_details['gallery_description'] ?></p>
			<?php endif ?>
			<?php if ( $gal_details['masonry_gallery_images'] ): ?>
				<div class="slmp-row slmp-masonry-image-items slmp-relative">
					<div class="masonry-col-<?php echo ( $col_count ? $col_count : '3' ) ?> slmp-display-image slmp-masonry-display-image slmp-relative">
						<?php foreach ( $gal_details['masonry_gallery_images'] as $masonry_image ) :
							$image = $thumbnail == 'full' ? $masonry_image['url'] : ( $thumbnail == 'slmp_thumbnail' ? $masonry_image['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $masonry_image['sizes']['thumbnail'] : $masonry_image['sizes']['slmp-gallery-thumbnail'] ) );
						?>
							<div class="slmp-image-item <?php echo ( $show_zoom ? 'zoom-icon-hover' : 'no-zoom-icon' ) ?> slmp-relative" data-id="slmp-<?php echo $gal_type ?>-item-<?php echo $masonry_image['id'] ?>-<?php echo $gal_id ?>">
								<div class="slmp-image slmp-relative">
									<div class="slmp-<?php echo $gal_type ?>-image slmp-relative">
										<img src="<?php echo $image ?>" alt="<?php echo $masonry_image['alt'] ?>" title="<?php echo $masonry_image['title'] ?>">
									</div>
									<?php if ( $show_title == true ): ?>
										<div class="slmp-image-label slmp-text-center"><?php echo $masonry_image['title'] ?></div>
									<?php endif ?>
									<?php if ( $show_zoom == true ): ?>
										<div class="slmp-image-hover-icon"></div>
									<?php endif ?>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>
<?php }