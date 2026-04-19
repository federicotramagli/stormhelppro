<?php

function album_category_gallery_layout() {
    $gal_type           = get_field('gallery_type');
    $gal_details        = get_field('gallery_details');
    $col_count          = get_field('image_column');
    $thumbnail          = get_field('image_thumbnail');
    $show_title         = get_field('display_title');
    $show_zoom          = get_field('image_zoom');
    $nav_style 			= get_field('category_nav_style') == 'list' ?  'list' : ( get_field('category_nav_style') == 'dropdown' ? 'dropdown' : 'list' );
    $gal_id             = get_the_id();
    $enable_load_more   = get_field('load_more_image');
    $load_show          = get_field('load_more_display');
    $load_more          = get_field('load_more_loaded');
    $load_label         = get_field('load_more_label');
?>
    <?php if ( $gal_type == 'album_category' ): ?>
        <div class="slmp-gallery slmp-album-category-gallery slmp-relative" gallery-id="<?php echo $gal_id ?>" gallery-type="<?php echo $gal_type ?>">
            <?php if ( $gal_details['gallery_title'] ): ?>
                <h2><?php echo $gal_details['gallery_title'] ?></h2>
            <?php endif ?>
            <?php if ( $gal_details['gallery_description'] ): ?>
                <p><?php echo $gal_details['gallery_description'] ?></p>
            <?php endif ?>
            <?php if ( $gal_details['album_category_gallery'] ):
                $al_new_cat = array();
            ?>
                <div class="slmp-category-navigation slmp-relative">
                    <?php foreach ( $gal_details['album_category_gallery'] as $new_cat ):
                        $categories = $new_cat['album_category_item'];
                        if ( $categories ) :
                            foreach ( $categories as $category ) :
                                $al_new_cat[] = $category;
                            endforeach;
                        endif;
                    ?>
                    <?php endforeach ?>
                    <?php $cat_items = array_unique($al_new_cat) ?>

                    <?php if ( $nav_style == 'list' ): ?>
                    	<div class="slmp-album-category-listing slmp-relative">
	                        <div class="slmp-cat-title active" data-cat="all">All</div>
	                        <?php if ( $cat_items ): ?>
	                            <?php foreach ( $cat_items as $cat_item ): ?>
	                                <div class="slmp-cat-title" data-cat="<?php echo $cat_item ?>"><?php echo $cat_item ?></div>
	                            <?php endforeach ?>
	                        <?php endif ?>
	                    </div>
                    <?php else : ?>
                    	<select class="slmp-cat-drop-down slmp-relative">
							<option value="all">All</option>
							<?php foreach ( $cat_items as $cat_item ): ?>
								<option value="<?php echo $cat_item ?>"><?php echo $cat_item ?></option>
							<?php endforeach ?>
						</select>
                    <?php endif ?>

                </div>
                <div class="slmp-category-loader slmp-text-center slmp-relative"></div>
                <div class="slmp-row slmp-album-category-image-items slmp-relative">
                    <div class="slmp-display-image slmp-album-category-display-image slmp-site-flex slmp-justify-content-left slmp-relative">
                        <?php foreach ( $gal_details['album_category_gallery'] as $key => $album_detail ) :
                            $al_title           = $album_detail['album_category_title'];
                            $al_description     = $album_detail['album_category_description'];
                            $al_thumb           = $album_detail['album_category_featured'];
                            $image              = $thumbnail == 'full' ? $al_thumb['url'] : ( $thumbnail == 'slmp_thumbnail' ? $al_thumb['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $al_thumb['sizes']['thumbnail'] : $al_thumb['sizes']['slmp-gallery-thumbnail'] ) );
                        ?>
                            <div class="slmp-col-<?php echo ( $col_count ? $col_count : '3' ) ?> slmp-image-item <?php echo ( $show_zoom ? 'zoom-icon-hover' : 'no-zoom-icon' ) ?> slmp-site-flex slmp-justify-content-center-center slmp-relative" data-id="slmp-<?php echo $gal_type ?>-item-<?php echo $al_thumb['id'] ?>-<?php echo $gal_id ?>">
                                <div class="slmp-image slmp-site-flex slmp-justify-content-center-center slmp-relative" data-key="<?php echo $key ?>">
                                    <div class="slmp-<?php echo $gal_type ?>-image slmp-text-center slmp-relative">
                                        <img src="<?php echo $image ?>" alt="<?php echo $al_thumb['alt'] ?>" title="<?php echo $al_thumb['title'] ?>">
                                    </div>
                                    <?php if ( $show_title == true ): ?>
                                        <div class="slmp-image-label slmp-text-center"><?php echo $al_thumb['title'] ?></div>
                                    <?php endif ?>
                                    <?php if ( $show_zoom == true ): ?>
                                        <div class="slmp-image-hover-icon"></div>
                                    <?php endif ?>
                                </div>
                                <?php if ( $al_title ): ?>
                                    <div class="slmp-album-title slmp-text-center slmp-relative"><?php echo $al_title ?></div>
                                <?php endif ?>
                                <?php if ( $al_description ): ?>
                                    <div class="slmp-album-description slmp-text-center slmp-relative"><?php echo $al_description ?></div>
                                <?php endif ?>
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