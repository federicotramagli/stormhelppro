<?php

namespace SLMP\inc\includes;

class create_folder {
	public function __construct() {
		$this->create_dynamic_folder();
		$this->create_dynamic_templates_folder();
		$this->create_dynamic_taxonomy_folder();
	}

	public function create_dynamic_folder() {
		if ( !is_dir( SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen' ) ) {
		    mkdir( SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen' , 0777, true );
		}
	}

	public function create_dynamic_templates_folder() {
		if ( !is_dir( SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-templates' ) ) {
		    mkdir( SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-templates' , 0777, true );
		}
	}

	public function create_dynamic_taxonomy_folder() {
		if ( !is_dir( SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-taxonomy' ) ) {
		    mkdir( SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-taxonomy' , 0777, true );
		}
	}

}