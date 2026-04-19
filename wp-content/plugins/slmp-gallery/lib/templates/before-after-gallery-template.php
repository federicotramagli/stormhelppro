<?php

function bf_gallery_layout() {
	$gal_type 			= get_field('gallery_type');
	$gal_details 		= get_field('gallery_details');


	$col_count 			= get_field('image_column');
	$thumbnail 			= get_field('image_thumbnail');
	$show_title 		= get_field('display_title');
	$show_zoom 			= get_field('image_zoom');
	$gal_id 			= get_the_id();
?>
	<?php if ( $gal_type == 'before_after' ): ?>
		<div class="slmp-gallery slmp-bf-gallery slmp-relative" gallery-id="<?php echo $gal_id ?>" gallery-type="<?php echo $gal_type ?>">
			<?php if ( $gal_details['gallery_title'] ): ?>
				<h2><?php echo $gal_details['gallery_title'] ?></h2>
			<?php endif ?>
			<?php if ( $gal_details['gallery_description'] ): ?>
				<p><?php echo $gal_details['gallery_description'] ?></p>
			<?php endif ?>

			<?php if ( $gal_details['bf_gallery'] ): ?>
				<div class="slmp-bf-gallery-images slmp-relative">
					<?php foreach ( $gal_details['bf_gallery'] as $bf_img ):
                        $before_img = $thumbnail == 'full' ? $bf_img['bf_before']['url'] : ( $thumbnail == 'slmp_thumbnail' ? $bf_img['bf_before']['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $bf_img['bf_before']['sizes']['thumbnail'] : $bf_img['bf_before']['sizes']['slmp-gallery-thumbnail'] ) );
                        $after_img = $thumbnail == 'full' ? $bf_img['bf_after']['url'] : ( $thumbnail == 'slmp_thumbnail' ? $bf_img['bf_after']['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $bf_img['bf_after']['sizes']['thumbnail'] : $bf_img['bf_after']['sizes']['slmp-gallery-thumbnail'] ) );

                        $bf_before_width = $thumbnail == 'full' ? $bf_img['bf_before']['width'] : ( $thumbnail == 'slmp_thumbnail' ? $bf_img['bf_before']['sizes']['slmp-gallery-thumbnail-width'] : ( $thumbnail == 'thumbnail' ? $bf_img['bf_before']['sizes']['thumbnail-width'] : $bf_img['bf_before']['sizes']['slmp-gallery-thumbnail-width'] ) );
                        $bf_before_height = $thumbnail == 'full' ? $bf_img['bf_before']['height'] : ( $thumbnail == 'slmp_thumbnail' ? $bf_img['bf_before']['sizes']['slmp-gallery-thumbnail-height'] : ( $thumbnail == 'thumbnail' ? $bf_img['bf_before']['sizes']['thumbnail-height'] : $bf_img['bf_before']['sizes']['slmp-gallery-thumbnail-height'] ) );
                    ?>
                        <div class="slmp-bf-image bf-image-item slmp-relative" style="max-width: <?php echo $bf_before_width ?>px;">
                            <img class="before-bf-img" src="<?php echo $before_img ?>" alt="<?php echo $bf_img['bf_before']['alt'] ?>" title="<?php echo $bf_img['bf_before']['title'] ?>">
                            <img class="after-bf-img" src="<?php echo $after_img ?>" alt="<?php echo $after_img['bf_before']['alt'] ?>" title="<?php echo $after_img['bf_before']['title'] ?>">
                            <input type="range" min="1" max="100" value="50" class="slmp-bf-slider">
                            <div class="slmp-bf-label slmp-bf-before-label">Before</div>
                            <div class="slmp-bf-label slmp-bf-after-label">After</div>
                            <div class="slmp-bf-slider-button"></div>
                        </div>
                    <?php endforeach ?>
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>
<?php }