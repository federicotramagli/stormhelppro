<?php

namespace SLMP\inc;

class theme_setup {

	public function __construct() {
		$this->dir = SLMP_THEME_CORE_DIR;

        add_filter('page_template', array(&$this, 'custom_page_template'));
        add_filter('taxonomy_template', array(&$this, 'custom_page_taxonomy'));
	}

	public function execute() {
        $this->includes();
        $this->fields();
        $this->templates();
        $this->scripts();
        $this->filters();
        $this->custom_shortcode();
        $this->custom_hook();
        $this->custom_acf_blocks();

        new includes\acf_includes;
        new includes\create_folder;
        new includes\create_file;
        new fields\acf_fields;
        new scripts\script;
        new filters\filter;

        return array(
            create_template(),
            create_taxonomy(),
            create_acf_block_template(),
        );
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

    public function templates() {
        $templates = glob($this->dir . '/templates/' . "*.php");
        foreach($templates as $template) {
            require_once $template;
        }
    }

    public function scripts() {
        $scripts = glob($this->dir . '/scripts/' . "*.php");
        foreach($scripts as $script) {
            require_once $script;
        }
    }

    public function filters() {
        $filters = glob($this->dir . '/filters/' . "*.php");
        foreach($filters as $filter) {
            require_once $filter;
        }
    }

    public function custom_shortcode() {
        $ct_shortcode = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-shortcode.php';
        if ( is_file($ct_shortcode) ) {
            require_once $ct_shortcode;
        }
    }

    public function custom_hook() {
        $ct_hook = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-hook.php';
        if ( is_file($ct_hook) ) {
            require_once $ct_hook;
        }
    }

    public function custom_acf_blocks() {
        $acf_blocks = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-acf-block.php';
        if ( is_file($acf_blocks) ) {
            require_once $acf_blocks;
        }
    }


    public function custom_page_template( $page_template ) {
        $templates = get_field('template_generator', 'options');
        if ( $templates ) {
            foreach ( $templates as $id_temp ) {
                if ( $id_temp['selected_page'] ) {
                    foreach ( $id_temp['selected_page'] as $id ) {
                        if ( is_page($id) ) {
                            $page_template = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-templates/'. $id_temp['template_filename'] .'.php';
                            return $page_template;
                        }
                    }
                }
            }
        }
    }

    public function custom_page_taxonomy( $taxonomy_template ) {
        $taxonomys = get_field('taxonomy_generator', 'options');
        if ( $taxonomys ) {
            foreach ( $taxonomys as $taxonomy ) {
                $term       = get_queried_object();
                if ( $term->taxonomy === $taxonomy['selected_taxonomy'] ) {
                    $page_taxonomy = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-taxonomy/'. $taxonomy['taxonomy_filename'] .'.php';
                    return $page_taxonomy;
                }
            }
        }
    }



}