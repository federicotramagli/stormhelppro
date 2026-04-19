<?php

namespace SLMP\inc\includes;

class acf_includes {
	public function __construct() {

		if(!class_exists('ACF')) {
            add_filter('acf/settings/path', array(&$this, 'modify_settings_path'));
			add_filter('acf/settings/dir', array(&$this, 'modify_settings_dir'));
        }

        require_once SLMP_THEME_CORE_DIR. '/vendors/acf-pro/acf.php';
	}

	public function modify_settings_path($path) {
		return SLMP_THEME_CORE_DIR . '/vendors/acf-pro/';
	}

	public function modify_settings_dir($dir) {
		return SLMP_THEME_CORE_URI . '/vendors/acf-pro/';
	}

}