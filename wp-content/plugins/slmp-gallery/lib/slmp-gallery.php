<?php

namespace SLMP\lib;

class gallery {

	public function __construct() {
		$this->dir = SLMP_GALLERY_PLUGIN_BASE_DIR . 'lib';
		add_filter('acf/load_value/key=slmp_gallery_shortcode', array(&$this, 'acf_gallery_read_only_shortcode'));
	}

	public function run() {
        $this->register_shortcode();
		$this->includes();
		$this->fields();

		new shortcode\my_shortcode;
		new includes\acf_includes;
		new includes\post_type;
		new includes\extra_script;
		new includes\ajax_request;
		new fields\acf_fields;
	}

    public function register_shortcode() {
		$shortcodes = glob($this->dir . '/shortcode/' . "*.php");

        foreach($shortcodes as $shortcode) {
            require_once $shortcode;
        }
	}

	public function includes() {
		$includes = glob($this->dir . '/includes/' . "*.php");

        foreach($includes as $include) {
            require_once $include;
        }
	}

	public function fields() {
		$fields = glob($this->dir . '/fields/' . "*.php");

        foreach($fields as $field) {
            require_once $field;
        }
	}

	public function acf_gallery_read_only_shortcode() {
		$post_id = $_GET['post'];

		if ( $post_id ) :
			return '[slmp_gallery id="'. $post_id .'"]';
		endif;
	}

}
