<?php 

namespace SLMP\lib\includes;

class post_type {

	public function __construct(){
		add_action('init', array(&$this, 'cpt_slmp_gallery'));
		add_filter( 'manage_edit-slmp_gallery_post_columns', array(&$this, 'my_slmp_gallery_columns'));
		add_action( 'manage_posts_custom_column', array(&$this, 'slmp_populate_gallery_columns'));
	}

	public static function cpt_slmp_gallery() {

		$labels = array(
		    "name" => __( "SLMP Gallery", "slmp-gallery" ),
		    "singular_name" => __( "SLMP Gallery", "slmp-gallery" ),
		    'add_new_item'        => __( "Add New Gallery", "slmp-gallery" ),
		    'edit_item'        => __( "Edit Gallery", "slmp-gallery" ),
		);

		$args = array(
		    "label"                         => __( "SLMP Gallery", "slmp-gallery" ),
		    "labels"                        => $labels,
		    "description"                   => "",
		    "public"                        => false,
		    "publicly_queryable"            => false,
		    "show_ui"                       => true,
		    "delete_with_user"              => false,
		    "show_in_rest"                  => true,
		    "rest_base"                     => "",
		    "rest_controller_class"         => "WP_REST_Posts_Controller",
		    "has_archive"                   => false,
		    "show_in_menu"                  => true,
		    "show_in_nav_menus"             => false,
		    "exclude_from_search"           => true,
		    "capability_type"               => "post",
		    "map_meta_cap"                  => true,
		    "hierarchical"                  => false,
		    "rewrite"                       => false,
		    "query_var"                     => true,
		    "supports"                      => array( "title" ),
		    'menu_icon'                     => 'dashicons-format-gallery',
		);

		register_post_type( "slmp_gallery_post", $args );
	}


	public static function my_slmp_gallery_columns( $columns ) {
	    $columns['cpt_slmp_gallery_srtcd'] = 'Shortcode';
	    unset( $columns['comments'] );
	    return $columns;
	}
	

	public static function slmp_populate_gallery_columns( $column ) {
	    if ( 'cpt_slmp_gallery_srtcd' == $column ) {
	        echo '[slmp_gallery id="'. get_the_ID() .'"]';
	    }
	}

}