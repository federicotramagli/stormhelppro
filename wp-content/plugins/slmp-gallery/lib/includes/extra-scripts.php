<?php 

namespace SLMP\lib\includes;

class extra_script {

	public function __construct(){
		add_action( 'admin_enqueue_scripts', array(&$this, 'slmp_gallery_load_admin_scripts') );
		add_action( 'wp_enqueue_scripts', array(&$this, 'slmp_gallery_load_scripts') );
	}

	public function slmp_gallery_load_admin_scripts() {
		wp_enqueue_style( 'slmp_admin_css', plugins_url() . '/slmp-gallery/dist/admin/css/slmp-gallery-admin-style.css', '1.0.0', 'all' );
		wp_enqueue_script( 'slmp_admin_js', plugins_url() . '/slmp-gallery/dist/admin/js/slmp-gallery-admin-script.js', array('jquery'), '1.0.0',true );
	}

	public function slmp_gallery_load_scripts() {

		/*
		*	SLMP CSS
		*/
		wp_enqueue_style( 
	        'slmp-gallery-css', 
	        plugins_url() . '/slmp-gallery/dist/css/slmp-gallery-style.css', 
	        '1.0.0', 
	        'all'
	    );

	    /*
		*	SLMP JS
		*/
	    wp_enqueue_script( 
	        'slmp-gallery-js', 
	        plugins_url() . '/slmp-gallery/dist/js/slmp-gallery-script.js',
	        array( 'jquery' ), 
	        '1.0.0',
	        true
	    );

	    /*
		*	SSlick CSS
		*/
	    wp_enqueue_style( 
	        'slmp-gallery-slick-css', 
	        plugins_url() . '/slmp-gallery/dist/css/slick.css', 
	        '1.0.0', 
	        'all'
	    );

	    /*
		*	SSlick JS
		*/
	    wp_enqueue_script( 
	        'slmp-gallery-slick-js', 
	        plugins_url() . '/slmp-gallery/dist/js/slick.js',
	        array( 'jquery' ), 
	        '1.0.0',
	        true
	    );

	    /*
		*	WP AJAX
		*/
	    wp_localize_script( 'slmp-gallery-js', 'ajax_object', array(
	        'ajax_url' => admin_url( 'admin-ajax.php' ),
	    ));
	}

}