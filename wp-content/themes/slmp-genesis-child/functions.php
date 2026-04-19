<?php
/**
*This file adds functions to the SLMP Theme.
*
*@package SLMP
*/

namespace SLMP;

if ( defined('ABSPATH') ) {
	$theme_dir_path 			= get_stylesheet_directory();
    $theme_dir_url  			= get_stylesheet_directory_uri();
    $theme_template_dir_path  	= get_template_directory();
    $upload_dir   				= wp_upload_dir();
    $upload_dir_path   			= $upload_dir['basedir'];
    $upload_dir_url  			= $upload_dir['baseurl'];
}

define('SLMP_THEME_BASE_DIR', $theme_dir_path);
define('SLMP_THEME_BASE_URI', $theme_dir_url);
define('SLMP_THEME_TEMPLATE_DIR', $theme_template_dir_path);
define('SLMP_THEME_BASE_FILE', __FILE__);
define('SLMP_THEME_CORE_DIR', SLMP_THEME_BASE_DIR . '/inc');
define('SLMP_THEME_CORE_URI', SLMP_THEME_BASE_URI . '/inc');
define('SLMP_THEME_UPLOAD_DIR', $upload_dir_path);
define('SLMP_THEME_UPLOAD_URI', $upload_dir_url);

require_once SLMP_THEME_BASE_DIR . '/inc/slmp-theme.php';
require_once SLMP_THEME_TEMPLATE_DIR . '/lib/init.php';

if ( defined('ABSPATH') ) {
    $slmp = new inc\theme_setup;
    $slmp->execute();
}

/*
*Starts the Genesis engine.
*/
if ( function_exists( 'genesis_register_responsive_menus' ) ) {
  genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
}
add_theme_support( 'html5', genesis_get_config( 'html5' ) );
add_theme_support( 'genesis-accessibility', genesis_get_config( 'accessibility' ) );
add_theme_support( 'genesis-responsive-viewport' );
add_theme_support( 'custom-logo', genesis_get_config( 'custom-logo' ) );
add_theme_support( 'genesis-menus', genesis_get_config( 'menus' ) );
add_theme_support( 'genesis-after-entry-widget-area' );

/*
* Include Custom Function
*/
$ct_function = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-function.php';
if ( is_file($ct_function) ) {
    require_once $ct_function;
}