<?php 

namespace SLMP\lib\includes;

class ajax_request {

	public function __construct(){
		add_action( 'wp_ajax_slmp_popup_image_request', array(&$this, 'slmp_popup_image_request'));
		add_action( 'wp_ajax_nopriv_slmp_popup_image_request', array(&$this, 'slmp_popup_image_request'));

		add_action( 'wp_ajax_slmp_category_request', array(&$this, 'slmp_category_request'));
		add_action( 'wp_ajax_nopriv_slmp_category_request', array(&$this, 'slmp_category_request'));
	}

	public function slmp_popup_image_request() {
		$result    			= array();
		$id 				= $_POST['id'];
		$type 				= $_POST['type'];
		$cat_data 			= $_POST['cat'];
		$dp_cat_data 		= $_POST['dp_cat'];
		$d_key 				= $_POST['d_key'];
		$gal_type 			= get_field('gallery_type', $id);
		$gal_details 		= get_field('gallery_details', $id);

		// Grid Slider Popup Ajax Request
		if ( $type == 'grid' ) :
			$images 			= $gal_details['grid_gallery_images'];
			if ( $images ) :
				foreach ( $images as $image ) :
					$result[] = array(
						"img_id" 	  => $image['id'],
						"url"         => $image['url'],
						"alt"         => $image['alt'],
						"title"       => $image['title'],
						"width"       => $image['width'],
						"height"      => $image['height'],
					);
				endforeach;
			endif;
		// Masonry Popup Ajax Request
		elseif ( $type == 'masonry' ) :
			$images 			= $gal_details['masonry_gallery_images'];
			if ( $images ) :
				foreach ( $images as $image ) :
					$result[] = array(
						"img_id" 	  => $image['id'],
						"url"         => $image['url'],
						"alt"         => $image['alt'],
						"title"       => $image['title'],
						"width"       => $image['width'],
						"height"      => $image['height'],
					);
				endforeach;
			endif;
		// Slide Slider Popup Ajax Request
		elseif ( $type == 'slide' ) :
			$images 			= $gal_details['slide_gallery_images'];
			if ( $images ) :
				foreach ( $images as $image ) :
					$result[] = array(
						"img_id" 	  => $image['id'],
						"url"         => $image['url'],
						"alt"         => $image['alt'],
						"title"       => $image['title'],
						"width"       => $image['width'],
						"height"      => $image['height'],
					);
				endforeach;
			endif;
		// Navigation Slider Popup Ajax Request
		elseif ( $type == 'navigation' ) :
			$images 			= $gal_details['navigation_gallery_images'];
			if ( $images ) :
				foreach ( $images as $image ) :
					$result[] = array(
						"img_id" 	  => $image['id'],
						"url"         => $image['url'],
						"alt"         => $image['alt'],
						"title"       => $image['title'],
						"width"       => $image['width'],
						"height"      => $image['height'],
					);
				endforeach;
			endif;
		elseif ( $type == 'category' ) :
			$categories 		= $gal_details['category_gallery'];
			if ( $categories ) :
				$image_id = array();
				foreach ( $categories as $cat_item ) :
					$cat_title 		= strtolower(str_replace(array("(",")","_"," "), "-", $cat_item['category_title']));
					if ( $cat_data === $cat_title ) :
						$cat_images = $cat_item['category_gallery_images'];
						if ( $cat_images ) :
							foreach ( $cat_images as $cat_image ) :	
								$image_id[] = $cat_image["id"];
							endforeach;
						endif;
					endif;
					if ( $dp_cat_data === $cat_title ) :
						$cat_images = $cat_item['category_gallery_images'];
						if ( $cat_images ) :
							foreach ( $cat_images as $cat_image ) :	
								$image_id[] = $cat_image["id"];
							endforeach;
						endif;
					endif;
					if ( $cat_data === 'all' ) :
						$cat_images = $cat_item['category_gallery_images'];;
						if ( $cat_images ) :
							foreach ( $cat_images as $cat_image ) :								
								$image_id[] = $cat_image["id"];
							endforeach;
						endif;
					endif;
					if ( $dp_cat_data === 'all' ) :
						$cat_images = $cat_item['category_gallery_images'];
						if ( $cat_images ) :
							foreach ( $cat_images as $cat_image ) :								
								$image_id[] = $cat_image["id"];
							endforeach;
						endif;
					endif;
				endforeach;
				$images = array_unique($image_id);
				rsort($images);
				if ( $images ) :
					foreach ( $images as $image_id ) :
						$id 			= wp_get_attachment_image_src( $image_id, 'full' );
						$image_alt 		= get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
						$image_title 	= get_the_title($image_id);

						$result[] = array(
							"img_id" 		  => $image_id,
							"url"         => $id[0],
							"width"       => $id[1],
							"height"      => $id[2],
							"alt"         => $image_alt,
							"title"       => $image_title,
						);
					endforeach;
				endif;
			endif;
		elseif ( $type == 'album' ) :
			$images 			= $gal_details['album_gallery'][$d_key]['album_gallery_images'];
			if ( $images ) :
				foreach ( $images as $image ) :
					$result[] = array(
						"img_id" 	  => $image['id'],
						"url"         => $image['url'],
						"alt"         => $image['alt'],
						"title"       => $image['title'],
						"width"       => $image['width'],
						"height"      => $image['height'],
					);
				endforeach;
			endif;
		elseif ( $type == 'album_slide' ) :
			$images 			= $gal_details['album_slide_gallery'][$d_key]['album_slide_gallery_images'];
			if ( $images ) :
				foreach ( $images as $image ) :
					$result[] = array(
						"img_id" 	  => $image['id'],
						"url"         => $image['url'],
						"alt"         => $image['alt'],
						"title"       => $image['title'],
						"width"       => $image['width'],
						"height"      => $image['height'],
					);
				endforeach;
			endif;
		elseif ( $type == 'album_category' ) :
			$images 			= $gal_details['album_category_gallery'][$d_key]['album_category_gallery_images'];
			if ( $images ) :
				foreach ( $images as $image ) :
					$result[] = array(
						"img_id" 	  => $image['id'],
						"url"         => $image['url'],
						"alt"         => $image['alt'],
						"title"       => $image['title'],
						"width"       => $image['width'],
						"height"      => $image['height'],
					);
				endforeach;
			endif;
		endif;	
		echo json_encode($result);
    	wp_die();
	}


	public function slmp_category_request() {

		$result    			= array();
		$id 				= $_POST['id'];
		$category 			= $_POST['cat'];
		$type 				= $_POST['type'];
		$gal_details 		= get_field('gallery_details', $id);
		$thumbnail 			= get_field('image_thumbnail', $id);
		$col_count 			= get_field('image_column', $id);
		$show_zoom 			= get_field('image_zoom', $id);
		$show_title 		= get_field('display_title', $id);

		if ( $type == 'category' ) :
			$categories 		= $gal_details['category_gallery'];
			if ( $categories ) :
				$image_id = array();
				foreach  ($categories as $cat_item ) :
					$cat_title 		= strtolower(str_replace(array("(",")","_"," "), "-", $cat_item['category_title']));
					if ( $category === $cat_title ) :
						$images = $cat_item['category_gallery_images'];
						rsort($images);
						if ( $images ) :
							foreach ( $images as $key => $image ) :
								$image_thumbnail = $thumbnail == 'full' ? $image['url'] : ( $thumbnail == 'slmp_thumbnail' ? $image['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $image['sizes']['thumbnail'] : $image['sizes']['slmp-gallery-thumbnail'] ) );
								$column 		= ( $col_count ? $col_count : '3' );
								$zoom 			= ( $show_zoom ? 'zoom-icon-hover' : 'no-zoom-icon' );
								$dp_title 		= ( $show_title == true ? true : false );
								$dp_icon 		= ( $show_zoom == true ? true : false );
								$result[] = array(
									"key" 		  => $key,
									"img_id" 	  => $image['id'],
									"url"         => $image_thumbnail,
									"alt"         => $image['alt'],
									"title"       => $image['title'],
									"column"      => $column,
									"zoom"        => $zoom,
									"dp_title"    => $dp_title,
									"dp_icon"     => $dp_icon,
								);
							endforeach;
						endif;
					endif;
					if ( $category === 'all' ) :
						$images = $cat_item['category_gallery_images'];
						if ( $images ) :
							foreach ( $images as $cat_image ) :	
								$image_id[] = $cat_image["id"];
							endforeach;
						endif;
					endif;
				endforeach;
				$images = array_unique($image_id);
				rsort($images);
				if ( $images ) :
					foreach ( $images as $key => $image_id ) :
						$wp_thumbnail 	= wp_get_attachment_image_src($image_id, 'thumbnail')[0];
						$slmp_thumbnail = wp_get_attachment_image_src($image_id, 'slmp-gallery-thumbnail')[0];
						$full 			= wp_get_attachment_image_src($image_id, 'full')[0];
						$image_alt 		= get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
						$image_title 	= get_the_title($image_id);
						$column 		= ( $col_count ? $col_count : '3' );
						$zoom 			= ( $show_zoom ? 'zoom-icon-hover' : 'no-zoom-icon' );
						$dp_title 		= ( $show_title == true ? true : false );
						$dp_icon 		= ( $show_zoom == true ? true : false );
						$image = $thumbnail == 'full' ? $full : ( $thumbnail == 'slmp_thumbnail' ? $slmp_thumbnail : ( $thumbnail == 'thumbnail' ? $wp_thumbnail : $slmp_thumbnail ) );
						$result[] = array(
							"key" 		    => $key,
							"img_id" 		=> $image_id,
							"url"         	=> $image,
							"alt"         	=> $image_alt,
							"title"       	=> $image_title,
							"column"      	=> $column,
							"zoom"        	=> $zoom,
							"dp_title"      => $dp_title,
							"dp_icon"     => $dp_icon,
						);
					endforeach;
				endif;
			endif;
		elseif ( $type == 'album_category' ) :
			$categories 		= $gal_details['album_category_gallery'];
			if ( $categories ) :
				foreach ( $categories as $key => $gal_item ) :
					$cat_item = $gal_item['album_category_item'];
					if ( in_array( $category, $cat_item) ) :
						$images 	= $gal_details['album_category_gallery'][$key];
						$al_title 	= $images['album_category_title'];
						$al_desc 	= $images['album_category_description'];
						$image 		= $images['album_category_featured'];
						$image_thumbnail = $thumbnail == 'full' ? $image['url'] : ( $thumbnail == 'slmp_thumbnail' ? $image['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $image['sizes']['thumbnail'] : $image['sizes']['slmp-gallery-thumbnail'] ) );
						$column 		= ( $col_count ? $col_count : '3' );
						$zoom 			= ( $show_zoom ? 'zoom-icon-hover' : 'no-zoom-icon' );
						$dp_title 		= ( $show_title == true ? true : false );
						$dp_icon 		= ( $show_zoom == true ? true : false );
						$result[] = array(
							"key" 		  => $key,
							"img_id" 	  => $image['id'],
							"url"         => $image_thumbnail,
							"alt"         => $image['alt'],
							"title"       => $image['title'],
							"column"      => $column,
							"zoom"        => $zoom,
							"dp_title"    => $dp_title,
							"dp_icon"     => $dp_icon,
							"al_title" 	  => $al_title,
							"al_desc" 	  => $al_desc,
						);
					endif;
					if ( in_array( $category == 'all', $cat_item) ) :
						$images 	= $gal_details['album_category_gallery'][$key];
						$al_title 	= $images['album_category_title'];
						$al_desc 	= $images['album_category_description'];
						$image 		= $images['album_category_featured'];
						$image_thumbnail = $thumbnail == 'full' ? $image['url'] : ( $thumbnail == 'slmp_thumbnail' ? $image['sizes']['slmp-gallery-thumbnail'] : ( $thumbnail == 'thumbnail' ? $image['sizes']['thumbnail'] : $image['sizes']['slmp-gallery-thumbnail'] ) );
						$column 		= ( $col_count ? $col_count : '3' );
						$zoom 			= ( $show_zoom ? 'zoom-icon-hover' : 'no-zoom-icon' );
						$dp_title 		= ( $show_title == true ? true : false );
						$dp_icon 		= ( $show_zoom == true ? true : false );
						$result[] = array(
							"key" 		  => $key,
							"img_id" 	  => $image['id'],
							"url"         => $image_thumbnail,
							"alt"         => $image['alt'],
							"title"       => $image['title'],
							"column"      => $column,
							"zoom"        => $zoom,
							"dp_title"    => $dp_title,
							"dp_icon"     => $dp_icon,
							"al_title" 	  => $al_title,
							"al_desc" 	  => $al_desc,
						);
					endif;
				endforeach;
			endif;
		endif;
			
		echo json_encode($result);
    	wp_die();
	}


}