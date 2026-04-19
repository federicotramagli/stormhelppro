<?php 

namespace SLMP\inc\filters;

class filter {

    public function __construct(){
        add_filter( 'genesis_register_sidebar_defaults', array(&$this, 'custom_register_sidebar_defaults'));
        add_filter( 'wp_nav_menu_args', array(&$this, 'slmp_blaze_secondary_menu_args'));
        add_filter( 'genesis_author_box_gravatar_size', array(&$this, 'slmp_blaze_author_box_gravatar'));
        add_filter( 'genesis_comment_list_args', array(&$this, 'slmp_blaze_comments_gravatar'));
        add_filter( 'genesis_customizer_theme_settings_config', array(&$this, 'slmp_blaze_remove_customizer_settings'));
        remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
        remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );
        add_action( 'get_header', array(&$this, 'remove_titles_all_single_pages'));
    }

    // Replace h1-h6 with div for all widget titles
    public function custom_register_sidebar_defaults( $defaults ) {
        $defaults['before_title'] = '<div class="widget-title widgettitle">';
        $defaults['after_title'] = '</div>';
        return $defaults;
    }

    // Reduces secondary navigation menu to one level depth.
    public function slmp_blaze_secondary_menu_args( $args ) {
        if ( 'secondary' !== $args['theme_location'] ) {
            return $args;
        }
        $args['depth'] = 1;
        return $args;
    }

    // Modifies size of the Gravatar in the author box.
    public function slmp_blaze_author_box_gravatar( $size ) {
        return 90;
    }

    // Modifies size of the Gravatar in the entry comments.
    public function slmp_blaze_comments_gravatar( $args ) {
        $args['avatar_size'] = 60;
        return $args;
    }

    // Removes output of header and front page breadcrumb settings in the Customizer.
    public function slmp_blaze_remove_customizer_settings( $config ) {
        unset( $config['genesis']['sections']['genesis_header'] );
        unset( $config['genesis']['sections']['genesis_breadcrumbs']['controls']['breadcrumb_front_page'] );
        return $config;
    }

    // Remove H1 in pages
    public function remove_titles_all_single_pages() {
        if ( is_singular('page') ) {
            remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
        }
    }

}