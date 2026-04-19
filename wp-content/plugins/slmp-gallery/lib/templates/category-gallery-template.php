<?php

function category_gallery_layout() {
	$gal_type 			= get_field('gallery_type');
	$gal_details 		= get_field('gallery_details');
	$col_count 			= get_field('image_column');
	$thumbnail 			= get_field('image_thumbnail');
	$show_title 		= get_field('display_title');
	$show_zoom 			= get_field('image_zoom');
	$nav_style 			= get_field('category_nav_style') == 'list' ?  'list' : ( get_field('category_nav_style') == 'dropdown' ? 'dropdown' : 'list' );
	$gal_id 			= get_the_id();
	$enable_load_more 	= get_field('load_more_image');
	$load_show 			= get_field('load_more_display');
	$load_more 			= get_field('load_more_loaded');
	$load_label 		= get_field('load_more_label');
?>
	<?php if ( $gal_type == 'category' ): ?>
		<div class="slmp-gallery slmp-category-gallery slmp-relative" gallery-id="<?php echo $gal_id ?>" gallery-type="<?php echo $gal_type ?>">
			<?php if ( $gal_details['gallery_title'] ): ?>
				<h2><?php echo $gal_details['gallery_title'] ?></h2>
			<?php endif ?>
			<?php if ( $gal_details['gallery_description'] ): ?>
				<p><?php echo $gal_details['gallery_description'] ?></p>
			<?php endif ?>
			<?php if ( $gal_details['category_gallery'] ):
				$image_result = array();
			?>
			<?php if ( $nav_style == 'list' ): ?>
				<div class="slmp-category-navigation slmp-relative">
						<div class="slmp-cat-title active" data-cat="all">All</div>
					<?php foreach ( $gal_details['category_gallery'] as $nav ):
						$data_cat = strtolower(str_replace(array("(",")","_"," "), "-", $nav['category_title']));
					?>
						<div class="slmp-cat-title" data-cat="<?php echo $data_cat ?>"><?php echo $nav['category_title'] ?></div>
					<?php endforeach ?>
				</div>
			<?php else : ?>
				<div class="slmp-category-navigation-select slmp-relative">
					<select class="slmp-cat-drop-down slmp-relative">
						<option value="all">All</option>
						<?php foreach ( $gal_details['category_gallery'] as $nav ):
							$data_cat = strtolower(str_replace(array("(",")","_"," "), "-", $nav['category_title']));
						?>
							<option value="<?php echo $data_cat ?>"><?php echo $nav['category_title'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			<?php endif ?>
				<div class="slmp-category-loader slmp-text-center slmp-relative"></div>
				<div class="slmp-row slmp-category-image-items slmp-relative">
					<div class="slmp-display-image slmp-category-display-image slmp-site-flex slmp-justify-content-left slmp-relative">
						<?php foreach ( $gal_details['category_gallery'] as $cat_image ) :
							if ( $cat_image['category_gallery_images'] ) :
								foreach ( $cat_image['category_gallery_images'] as $image ) :
									$image_result[] = $image["id"];
								endforeach;
							endif;
						?>
						<?php endforeach ?>
						<?php
							$images = array_unique($image_result);
							rsort($images);
						?>

						<?php if ( $images ) :
							foreach ( $images as $image_id ) :
								$wp_thumbnail 		= wp_get_attachment_image_src($image_id, 'thumbnail')[0];
								$slmp_thumbnail 	= wp_get_attachment_image_src($image_id, 'slmp-gallery-thumbnail')[0];
								$full 				= wp_get_attachment_image_src($image_id, 'full')[0];
								$image_alt 			= get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
								$image_title 		= get_the_title($image_id);

								$image = $thumbnail == 'full' ? $full : ( $thumbnail == 'slmp_thumbnail' ? $slmp_thumbnail : ( $thumbnail == 'thumbnail' ? $wp_thumbnail : $slmp_thumbnail ) );
							?>
								<div class="slmp-col-<?php echo ( $col_count ? $col_count : '3' ) ?> slmp-image-item <?php echo ( $show_zoom ? 'zoom-icon-hover' : 'no-zoom-icon' ) ?> slmp-site-flex slmp-justify-content-center-center slmp-relative" data-id="slmp-<?php echo $gal_type ?>-item-<?php echo $image_id ?>-<?php echo $gal_id ?>">
									<div class="slmp-image slmp-site-flex slmp-justify-content-center-center slmp-relative">
										<div class="slmp-<?php echo $gal_type ?>-image slmp-text-center slmp-relative">
											<img src="<?php echo $image ?>" alt="<?php echo $image_alt ?>" title="<?php echo $image_title ?>">
										</div>
										<?php if ( $show_title == true ): ?>
											<div class="slmp-image-label slmp-text-center"><?php echo $image_title ?></div>
										<?php endif ?>
										<?php if ( $show_zoom == true ): ?>
											<div class="slmp-image-hover-icon"></div>
										<?php endif ?>
									</div>
								</div>
							<?php endforeach ?>
						<?php endif ?>
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