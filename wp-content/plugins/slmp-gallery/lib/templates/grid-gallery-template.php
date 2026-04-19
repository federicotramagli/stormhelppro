<?php

function grid_gallery_layout() {
	$gal_type 			= get_field('gallery_type');
	$gal_details 		= get_field('gallery_details');
	$col_count 			= get_field('image_column');
	$thumbnail 			= get_field('image_thumbnail');
	$show_title 		= get_field('display_title');
	$show_zoom 			= get_field('image_zoom');
	$gal_id 			= get_the_id();
	$enable_load_more 	= get_field('load_more_image');
	$load_show 			= get_field('load_more_display');
	$load_more 			= get_field('load_more_loaded');
	$load_label 		= get_field('load_more_label');
?>
	<?php if ( $gal_type == 'grid' ): ?>
		<div class="slmp-gallery slmp-grid-gallery slmp-relative" gallery-id="<?php echo $gal_id ?>" gallery-type="<?php echo $gal_type ?>">
			<?php if ( $gal_details['gallery_title'] ): ?>
				<h2><?php echo $gal_details['gallery_title'] ?></h2>
			<?php endif ?>
			<?php if ( $gal_details['gallery_description'] ): ?>
				<p><?php echo $gal_details['gallery_description'] ?></p>
			<?php endif ?>
			<?php if ( $gal_details['grid_gallery_images'] ): ?>
				<div class="slmp-row slmp-grid-image-items slmp-relative">
					<div class="slmp-display-image slmp-grid-display-image slmp-site-flex slmp-justify-content-left slmp-relative">
						<?php foreach ( $gal_details['grid_gallery_images'] as $grid_image ) :
							$image = $thumbnail == 'full' ? $grid_image['url'] : ( $thumbnail == 'slmp_thumbnail' ? $grid_image['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $grid_image['sizes']['thumbnail'] : $grid_image['sizes']['slmp-gallery-thumbnail'] ) );
						?>
							<div class="slmp-col-<?php echo ( $col_count ? $col_count : '3' ) ?> slmp-image-item <?php echo ( $show_zoom ? 'zoom-icon-hover' : 'no-zoom-icon' ) ?> slmp-site-flex slmp-justify-content-center-center slmp-relative" data-id="slmp-<?php echo $gal_type ?>-item-<?php echo $grid_image['id'] ?>-<?php echo $gal_id ?>">
								<div class="slmp-image slmp-site-flex slmp-justify-content-center-center slmp-relative">
									<div class="slmp-<?php echo $gal_type ?>-image slmp-text-center slmp-relative">
										<img src="<?php echo $image ?>" alt="<?php echo $grid_image['alt'] ?>" title="<?php echo $grid_image['title'] ?>">
									</div>
									<?php if ( $show_title == true ): ?>
										<div class="slmp-image-label slmp-text-center"><?php echo $grid_image['title'] ?></div>
									<?php endif ?>
									<?php if ( $show_zoom == true ): ?>
										<div class="slmp-image-hover-icon"></div>
									<?php endif ?>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
				<?php if ( $enable_load_more == true ): ?>
					<div class="slmp-gallery-load-more slmp-text-center slmp-relative" data-show="<?php echo $load_show ?>" data-load="<?php echo $load_more ?>">
						<button><?php echo $load_label ?></button>
					</div>
				<?php endif ?>
			<?php endif ?>
		</div>
	<?php endif ?>
<?php }