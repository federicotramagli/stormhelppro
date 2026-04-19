<?php

function video_grid_gallery_layout() {
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
	<?php if ( $gal_type == 'video_grid' ): ?>
		<div class="slmp-gallery slmp-video-grid-gallery slmp-relative" gallery-id="<?php echo $gal_id ?>" gallery-type="<?php echo $gal_type ?>">
			<?php if ( $gal_details['gallery_title'] ): ?>
				<h2><?php echo $gal_details['gallery_title'] ?></h2>
			<?php endif ?>
			<?php if ( $gal_details['gallery_description'] ): ?>
				<p><?php echo $gal_details['gallery_description'] ?></p>
			<?php endif ?>
			<?php if ( $gal_details['video_grid_gallery'] ): ?>
				<div class="slmp-row slmp-grid-image-items slmp-relative">
					<div class="slmp-display-image slmp-grid-display-image slmp-site-flex slmp-justify-content-left slmp-relative">
						<?php foreach ( $gal_details['video_grid_gallery'] as $video_grid ) :
							$selected		= $video_grid['video_grid_select'];
						?>
							<?php if ( $selected == 'youtube' ) :
								$custom_thumb 	= $video_grid['video_grid_thumbnail']['url'];
								$video_url 		= $video_grid['video_grid_url'];
								$vid_id 		= str_replace('https://www.youtube.com/embed/', '', $video_url );
								$video_thumb 	= 'https://img.youtube.com/vi/'. $vid_id .'/sddefault.jpg';
							?>
								<div class="slmp-col-<?php echo ( $col_count ? $col_count : '3' ) ?> slmp-video-item background-image slmp-relative" style="background-image: url(<?php echo ( $custom_thumb ? $custom_thumb : $video_thumb ) ?>)">
									<div class="slmp-play-icon" data-video="<?php echo $video_url ?>?rel=0&autoplay=1" data-type="<?php echo $selected ?>">
										<img src="/wp-content/plugins/slmp-gallery/dist/images/slmp-play-icon.png" alt="Play" title="Play">
									</div>
								</div>
							<?php elseif ( $selected == 'local' ) :
								$custom_thumb 	= $video_grid['video_grid_thumbnail']['url'];
								$video_url 		= $video_grid['video_grid_url'];
							?>
								<div class="slmp-col-<?php echo ( $col_count ? $col_count : '3' ) ?> slmp-video-item background-image slmp-relative" style="background-image: url(<?php echo $custom_thumb ?>)">
									<div class="slmp-play-icon" data-video="<?php echo $video_url ?>" data-type="<?php echo $selected ?>">
										<img src="/wp-content/plugins/slmp-gallery/dist/images/slmp-play-icon.png" alt="Play" title="Play">
									</div>
								</div>
							<?php endif ?>
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