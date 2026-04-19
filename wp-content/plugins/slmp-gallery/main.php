<?php
/**
 * Plugin Name: SLMP Gallery
 * Description: SLMP Gallery wordpress plugin.
 * Version:     0.0.1
 * Author:      Web Dev
 * Author URI:  https://surefirelocal.com/
 * Text Domain: surefirelocal
 */

namespace SLMP;

if ( defined('ABSPATH') ) {
	$plugin_dir_path = plugin_dir_path( __FILE__ );
    $plugin_dir_url  = plugin_dir_url( __FILE__ );
}


define('SLMP_GALLERY_PLUGIN_BASE_DIR', $plugin_dir_path);
define('SLMP_GALLERY_PLUGIN_BASE_FILE', __FILE__);
define('SLMP_GALLERY_PLUGIN_CORE_PATH', SLMP_GALLERY_PLUGIN_BASE_DIR . 'lib');
define('SLMP_GALLERY_PLUGIN_URI', $plugin_dir_url);

require_once SLMP_GALLERY_PLUGIN_BASE_DIR. '/lib/slmp-gallery.php';

if ( defined('ABSPATH') ) {
    $slmp = new lib\gallery;
    $slmp->run();
}

/*
*	SLMP Custom Image Size
*/
add_image_size( 'slmp-gallery-thumbnail', 400, 300, true );