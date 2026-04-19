<?php

function bf_slide_gallery_layout() {
	$gal_type 			= get_field('gallery_type');
	$gal_details 		= get_field('gallery_details');
	$thumbnail 			= get_field('image_thumbnail');
	$gal_id 			= get_the_id();
	$dots               = ( get_field('slick_bf_dots') ? 'true' : 'false' );
    $infinite           = ( get_field('slick_bf_infinite') ? 'true' : 'false' );
    $fade               = ( get_field('slick_bf_fade') ? 'true' : 'false' );
    $pause              = ( get_field('slick_bf_pauseOnHover') ? 'true' : 'false' );
    $auto               = ( get_field('slick_bf_autoplay') ? 'true' : 'false' );
    $adaptive           = ( get_field('slick_bf_adaptiveHeight') ? 'true' : 'false' );
    $speed              = ( get_field('slick_bf_speed') == "" ? 500 : (int)get_field('slick_bf_speed') );
    $autoplaySpeed      = ( get_field('slick_bf_autoplaySpeed') == "" ? 5000 : (int)get_field('slick_bf_autoplaySpeed') );
?>
	<?php if ( $gal_type == 'before_after_slide' ): ?>
		<div class="slmp-gallery slmp-bf-slide-gallery slmp-relative" gallery-id="<?php echo $gal_id ?>" gallery-type="<?php echo $gal_type ?>">
			<?php if ( $gal_details['gallery_title'] ): ?>
				<h2><?php echo $gal_details['gallery_title'] ?></h2>
			<?php endif ?>
			<?php if ( $gal_details['gallery_description'] ): ?>
				<p><?php echo $gal_details['gallery_description'] ?></p>
			<?php endif ?>

			<?php if ( $gal_details['bf_slide_gallery'] ): ?>
				<div class="slmp-bf-slide-gallery-wrap slmp-relative">
					<div class="slmp-bf-slide-gallery-images slmp-relative" data-dots="<?php echo $dots  ?>" data-infinite="<?php echo $infinite ?>" data-fade="<?php echo $fade ?>" data-pause="<?php echo $pause ?>" data-autoplay="<?php echo $auto ?>" data-adaptive="<?php echo $adaptive ?>" data-speed="<?php echo $speed ?>" data-autoplay-speed="<?php echo $autoplaySpeed ?>">
						<?php foreach ( $gal_details['bf_slide_gallery'] as $bf_img ):
	                        $before_img = $thumbnail == 'full' ? $bf_img['bf_slide_before']['url'] : ( $thumbnail == 'slmp_thumbnail' ? $bf_img['bf_slide_before']['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $bf_img['bf_slide_before']['sizes']['thumbnail'] : $bf_img['bf_slide_before']['sizes']['slmp-gallery-thumbnail'] ) );
	                        $after_img = $thumbnail == 'full' ? $bf_img['bf_slide_after']['url'] : ( $thumbnail == 'slmp_thumbnail' ? $bf_img['bf_slide_after']['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $bf_img['bf_slide_after']['sizes']['thumbnail'] : $bf_img['bf_slide_after']['sizes']['slmp-gallery-thumbnail'] ) );

	                        $bf_slide_before_width = $thumbnail == 'full' ? $bf_img['bf_slide_before']['width'] : ( $thumbnail == 'slmp_thumbnail' ? $bf_img['bf_slide_before']['sizes']['slmp-gallery-thumbnail-width'] : ( $thumbnail == 'thumbnail' ? $bf_img['bf_slide_before']['sizes']['thumbnail-width'] : $bf_img['bf_slide_before']['sizes']['slmp-gallery-thumbnail-width'] ) );
	                        $bf_slide_before_height = $thumbnail == 'full' ? $bf_img['bf_slide_before']['height'] : ( $thumbnail == 'slmp_thumbnail' ? $bf_img['bf_slide_before']['sizes']['slmp-gallery-thumbnail-height'] : ( $thumbnail == 'thumbnail' ? $bf_img['bf_slide_before']['sizes']['thumbnail-height'] : $bf_img['bf_slide_before']['sizes']['slmp-gallery-thumbnail-height'] ) );
	                    ?>
		                    <div class="slmp-bf-slide-image-wrap slmp-relative">
		                    	<div class="slmp-bf-image bf-image-item slmp-relative" style="max-width: <?php echo $bf_slide_before_width ?>px;">
		                            <img class="before-bf-img" src="<?php echo $before_img ?>" alt="<?php echo $bf_img['bf_slide_before']['alt'] ?>" title="<?php echo $bf_img['bf_slide_before']['title'] ?>">
		                            <img class="after-bf-img" src="<?php echo $after_img ?>" alt="<?php echo $after_img['bf_slide_before']['alt'] ?>" title="<?php echo $after_img['bf_slide_before']['title'] ?>">
		                            <input type="range" min="1" max="100" value="50" class="slmp-bf-slider">
		                            <div class="slmp-bf-label slmp-bf-before-label">Before</div>
		                            <div class="slmp-bf-label slmp-bf-after-label">After</div>
		                            <div class="slmp-bf-slider-button"></div>
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