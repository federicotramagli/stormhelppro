<?php

namespace SLMP\lib\shortcode;

class my_shortcode {
	
	public function __construct() {
		add_shortcode('slmp_gallery', array(&$this, 'slmp_gallery'));
		add_action('wp_footer', array(&$this, 'slmp_popup_template'));
	}

	public function slmp_gallery($atts) {
		ob_start();

		if ($atts) :

			extract(shortcode_atts(array(
			    'id' => null,
			    'posts_per_page' => '1',
			    'caller_get_posts' => 1)
			    , $atts)
			);

		    $args = array(
		    'post_type' => 'slmp_gallery_post',
		    'numberposts' => -1
		    );

		    if ( $atts['id'] ) :
		    	$args['p'] = $atts['id'];
		    else :
		    	return null;
		    endif;

		    global $post;
		    $posts = new \WP_Query($args); 

		    if ($posts->have_posts()) :
				while ($posts->have_posts()) : $posts->the_post();

					echo album_gallery_layout();
					echo album_slide_gallery_layout();
					echo album_category_gallery_layout();
					echo grid_gallery_layout();
					echo slide_gallery_layout();
					echo navigation_gallery_layout();
					echo category_gallery_layout();
					echo bf_gallery_layout();
					echo bf_slide_gallery_layout();
					echo masonry_gallery_layout();
					echo video_grid_gallery_layout();
					echo video_slide_gallery_layout();

				endwhile;
			else :
			    return;
			endif;
			wp_reset_query();

		endif;

		return ob_get_clean();
	}

	public function slmp_popup_template() { 
		echo slmp_popup_template();
	}
 
}

/*
*	Template Files
*/
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/album-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/album-slide-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/album-category-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/grid-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/masonry-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/slide-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/category-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/navigation-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/before-after-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/before-after-slide-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/video-slide-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/video-grid-gallery-template.php';
require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/templates/slmp-popup-template.php';