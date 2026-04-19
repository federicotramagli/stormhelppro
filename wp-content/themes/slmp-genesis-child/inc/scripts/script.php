<?php 

namespace SLMP\inc\scripts;

class script {

	public function __construct(){
		add_action( 'admin_enqueue_scripts', array(&$this, 'slmp_theme_load_admin_scripts') );
		add_action( 'wp_enqueue_scripts', array(&$this, 'slmp_theme_load_scripts') );
	}

	public function slmp_theme_load_admin_scripts() {
		wp_enqueue_style( 'slmp_theme_admin_css', SLMP_THEME_BASE_URI . '/dist/admin/css/admin-style.css' );
		wp_enqueue_script( 'slmp_theme_admin_js', SLMP_THEME_BASE_URI . '/dist/admin/js/admin-script.js' );
	}

	public function slmp_theme_load_scripts() {

		/*
		*	Theme Default CSS
		*/
	    wp_enqueue_style( 
	        'slmp-theme-default-css', 
	        SLMP_THEME_BASE_URI . '/dist/css/default-css.css', 
	        '1.0.0', 
	        'all'
	    );

	    /*
		*	Slick CSS
		*/
	    wp_enqueue_style( 
	        'slmp-theme-slick-css', 
	        SLMP_THEME_BASE_URI . '/dist/css/slick.css', 
	        '1.0.0', 
	        'all'
	    );

	    /*
	    * 	SLMP Custom CSS
	    */
		wp_enqueue_style( 
	        'slmp-custom-theme-css', 
	        SLMP_THEME_UPLOAD_URI . '/slmp-dynamic-gen/dynamic-custom-css.css', 
	        '1.0.0', 
	        'all'
	    );

	    /*
		*	Slick JS
		*/
	    wp_enqueue_script( 
	        'slmp-theme-slick-js', 
	        SLMP_THEME_BASE_URI . '/dist/js/slick.js',
	        array( 'jquery' ), 
	        '1.0.0',
	        true
	    );

	    /*
		*	Match Height JS
		*/
	    wp_enqueue_script( 
	        'slmp-theme-match-height-js', 
	        SLMP_THEME_BASE_URI . '/dist/js/jquery.matchHeight.min.js',
	        array( 'jquery' ), 
	        '1.0.0',
	        true
	    );

	    /*
		*	Lazyload JS
		*/
	    wp_enqueue_script( 
	        'slmp-theme-lazyload-js', 
	        SLMP_THEME_BASE_URI . '/dist/js/lazyload.js',
	        array( 'jquery' ), 
	        '2.0.0',
	        true
	    );

	    /*
	    *	SLMP Custom JS
	    */
	    wp_enqueue_script( 
	        'slmp-custom-theme-js', 
	        SLMP_THEME_UPLOAD_URI . '/slmp-dynamic-gen/dynamic-custom-js.js',
	        array( 'jquery' ), 
	        '1.0.0',
	        true
	    );

	    /*
		*	WP AJAX
		*/
	    wp_localize_script( 'slmp-custom-theme-js', 'ajax_object', array(
	        'ajax_url' => admin_url( 'admin-ajax.php' ),
	    ));
	}

}