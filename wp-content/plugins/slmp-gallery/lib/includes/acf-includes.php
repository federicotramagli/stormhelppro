<?php

namespace SLMP\lib\includes;

class acf_includes {
	public function __construct() {

		require_once SLMP_GALLERY_PLUGIN_CORE_PATH. '/vendors/advanced-custom-fields-pro/acf.php';

		if(!class_exists('ACF')) {
            add_filter('acf/settings/path', array(&$this, 'modify_settings_path'));
			add_filter('acf/settings/dir', array(&$this, 'modify_settings_dir'));
        }
	}

	public function modify_settings_path($path) {
		return SLMP_GALLERY_PLUGIN_CORE_PATH . '/vendors/advanced-custom-fields-pro/';
	}

	public function modify_settings_dir($dir) {
		return SLMP_GALLERY_PLUGIN_CORE_PATH . '/vendors/advanced-custom-fields-pro/';
	}

}