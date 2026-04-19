<?php

namespace SLMP\inc\includes;

class create_file {
	public function __construct() {
		if( class_exists('ACF') ) {
			add_action('acf/save_post', array(&$this, 'create_dynamic_shortcode_file'));
			add_action('acf/save_post', array(&$this, 'create_dynamic_hook_file'));
			add_action('acf/save_post', array(&$this, 'create_dynamic_acf_block_file'));
			add_action('acf/save_post', array(&$this, 'create_dynamic_function_file'));
			add_action('acf/save_post', array(&$this, 'create_dynamic_css_file'));
			add_action('acf/save_post', array(&$this, 'create_dynamic_jquery_file'));
			add_action('acf/save_post', array(&$this, 'create_dynamic_not_found_page_file'));
			add_action('acf/save_post', array(&$this, 'create_dynamic_search_page_file'));
			add_action('acf/save_post', array(&$this, 'create_dynamic_archive_page_file'));
			add_action('acf/save_post', array(&$this, 'create_dynamic_single_post_file'));
        }
	}

	/* Create Upload Custom CSS */
	public function create_dynamic_css_file() {
		if ( function_exists('acf_add_options_page') ) {

			$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-css.css';
			$my_file 	= fopen($file,'w');
			$contents 	= get_field('custom_css', 'option');

			fwrite($my_file, $contents);
			fclose($my_file);
			chmod($file, 0777);
		}
	}

	/* Create Upload Custom JS */
	public function create_dynamic_jquery_file() {
		if ( function_exists('acf_add_options_page') ) {

			$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-js.js';
			$my_file 	= fopen($file,'w');
			$contents 	= get_field('custom_jquery', 'option');

			fwrite($my_file, $contents);
			fclose($my_file);
			chmod($file, 0777);
		}
	}

	/* Create Upload Custom Function */
	public function create_dynamic_function_file() {
		if ( function_exists('acf_add_options_page') ) {

			$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-function.php';
			$my_file 	= fopen($file,'w');
			$contents 	= get_field('custom_function', 'option');

			fwrite($my_file, $contents);
			fclose($my_file);
			chmod($file, 0777);
		}
	}

	/* Create Upload Custom 404 Page */
	public function create_dynamic_not_found_page_file() {
		if ( function_exists('acf_add_options_page') ) {

			$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-404-page.php';
			$my_file 	= fopen($file,'w');
			$contents 	= get_field('404_content', 'options');
			$default 	= file_get_contents(SLMP_THEME_BASE_DIR . '/inc/defaults/deafult-404.txt');

			if ( $contents ) {
				fwrite($my_file, $contents);
			} else {
				fwrite($my_file, $default);
			}
			fclose($my_file);
			chmod($file, 0777);
		}
	}

	/* Create Upload Custom Search Page */
	public function create_dynamic_search_page_file() {
		if ( function_exists('acf_add_options_page') ) {

			$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-search-page.php';
			$my_file 	= fopen($file,'w');
			$contents 	= get_field('search_content', 'options');
			$default 	= file_get_contents(SLMP_THEME_BASE_DIR . '/inc/defaults/deafult-search.txt');

			if ( $contents ) {
				fwrite($my_file, $contents);
			} else {
				fwrite($my_file, $default);
			}
			fclose($my_file);
			chmod($file, 0777);
		}
	}

	/* Create Upload Custom Archive Page */
	public function create_dynamic_archive_page_file() {
		if ( function_exists('acf_add_options_page') ) {

			$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-archive-page.php';
			$my_file 	= fopen($file,'w');
			$contents 	= get_field('archive_content', 'options');
			$default 	= file_get_contents(SLMP_THEME_BASE_DIR . '/inc/defaults/deafult-archive.txt');

			if ( $contents ) {
				fwrite($my_file, $contents);
			} else {
				fwrite($my_file, $default);
			}
			fclose($my_file);
			chmod($file, 0777);
		}
	}

	/* Create Upload Custom Archive Page */
	public function create_dynamic_single_post_file() {
		if ( function_exists('acf_add_options_page') ) {

			$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-single-post.php';
			$my_file 	= fopen($file,'w');
			$contents 	= get_field('single_content', 'options');
			$default 	= file_get_contents(SLMP_THEME_BASE_DIR . '/inc/defaults/deafult-single.txt');

			if ( $contents ) {
				fwrite($my_file, $contents);
			} else {
				fwrite($my_file, $default);
			}
			fclose($my_file);
			chmod($file, 0777);
		}
	}


	/* Create Upload Custom Shortcode */
	public function create_dynamic_shortcode_file() {
		if ( function_exists('acf_add_options_page') ) {

			$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-shortcode.php';
			$my_file 	= fopen($file,'w');
			$contents = '<?php' . "\n" . '/**' . "\n" . ' * Build Custom Shortcode Boxes.' . "\n" . ' *' . "\n" . ' * @package Dynamik' . "\n" . ' */' . "\n" . "\n" . "\n";
			$sr_contents 			= get_field('shortcode_generator', 'option');
			$single_quote 		= "'";

			if ( $sr_contents ) {
				foreach ( $sr_contents as $value ) {
					$name 				= $value['shortcode_title'];
					$desire_shortcode 	= $value['shortcode_desire'];
					$content 			= $value['shortcode_content'];
					$new_name 			= strtolower( str_replace( array("(",")","-"," "),"_", $desire_shortcode ) );

					$contents .= '/* Name: ' . $name . ' */' . "\n";
					$contents .= 'add_shortcode( '. $single_quote . $new_name . $single_quote .', '. $single_quote . $new_name . $single_quote .' );' . "\n";
					$contents .= 'function '. $new_name .'(){'. "\n";
					$contents .= "\t" .'ob_start();'. "\n";
					$contents .= "\t" .''. $new_name .'_shortcode_content();'. "\n";
					$contents .= "\t" .'$output_string = ob_get_contents();'. "\n";
					$contents .= "\t" .'ob_end_clean();'. "\n";
					$contents .= "\t" .'return $output_string;'. "\n";
					$contents .= '}' . "\n". "\n";
					$contents .= 'function '. $new_name .'_shortcode_content(){ ?>'. "\n";
					$contents .= ''. $content  .''. "\n";
					$contents .= '<?php' . "\n";
					$contents .= '}' . "\n";
					$contents .= "\n";
					$contents .= "\n";
				}

			}

			fwrite($my_file, $contents);
			fclose($my_file);
			chmod($file, 0777);
		}
	}


	/* Create Upload Custom Hooks */
	public function create_dynamic_hook_file() {
		if ( function_exists('acf_add_options_page') ) {

			$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-hook.php';
			$my_file 	= fopen($file,'w');
			$dynamik_hook_boxes = '<?php' . "\n" . '/**' . "\n" . ' * Build Custom Hook Boxes.' . "\n" . ' *' . "\n" . ' * @package Dynamik' . "\n" . ' */' . "\n" . "\n" . "\n";
			$contents 			= get_field('hooks_generator', 'option');
			$single_quote 		= "'";

			if ( $contents ) {
				foreach ( $contents as $dynamik_hook => $value ) {
					$name 				= $value['hook_title'];
					$content 			= $value['hook_content'];
					$position 			= $value['hook_position'];
					$priority 			= $value['hook_priority'];
					$conditions 		= $value['hooks_statement'];
					$active 			= $value['hooks_activate'];
					$new_name 			= strtolower( str_replace( array("(",")","-"," "),"_", $name ) );

					if ( $active != 0 ) {
						$dynamik_hook_boxes .= '/* Name: ' . $name . ' */' . "\n" ;
						$dynamik_hook_boxes .= 'add_action( '. $single_quote . $position . $single_quote .', '. $single_quote . $new_name . $single_quote .', '. ( $priority ? $priority : 10 ) .' );' . "\n";
						$dynamik_hook_boxes .= 'function '. $new_name .'(){'. "\n";
						$dynamik_hook_boxes .= "\t" .''. $new_name .'_hook_content();'. "\n";
						$dynamik_hook_boxes .= '}' . "\n". "\n";
						$dynamik_hook_boxes .= 'function '. $new_name .'_hook_content(){ ?>'. "\n";

						$comma_string 	= array();
						if ( $conditions ) {
							foreach ( $conditions as $condition) {
								$new_cond 		= $condition['selected_statement'];
								$pages 			= $condition['selected_page'];
								$not_pages 		= $condition['selected_not_page'];
								$myPage 		= array();

								if ( $new_cond === 'is_page' ) {
									if ( $pages ) {
										foreach ( $pages as $page ) {
											$myPage[] = $page;
										}
									}	
								}

								if ( $new_cond === '!is_page' ) {
									if ( $not_pages ) {
										foreach ( $not_pages as $page ) {
											$myPage[] = $page;
										}
									}	
								}

								$comma_string[] = ''. $new_cond .'('. ( $new_cond === 'is_page' || $new_cond === '!is_page' ? 'array('. implode(",", $myPage) .')' : '' ) .')';
							}
						}

						if ( $conditions ) {
							$dynamik_hook_boxes .= '<?php if('. implode(" || ", $comma_string) .'){ ?>' . "\n";
						}
						$dynamik_hook_boxes .= ''. $content  .''. "\n";
						$dynamik_hook_boxes .= '<?php' . "\n";
						if ( $conditions ) {
							$dynamik_hook_boxes .= '}' . "\n";
						}
						$dynamik_hook_boxes .= '}' . "\n";
						$dynamik_hook_boxes .= "\n";
						$dynamik_hook_boxes .= "\n";
					}

				}
			}

			fwrite($my_file, $dynamik_hook_boxes);
			fclose($my_file);
			chmod($file, 0777);
		}
	}


	/* Create Upload Custom Hooks */
	public function create_dynamic_acf_block_file() {
		if ( function_exists('acf_add_options_page') ) {

			$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-acf-block.php';
			$my_file 	= fopen($file,'w');
			$contents 	= stripslashes( '<?php' . "\n" . '/**' . "\n" . ' * Build Custom ACF Blocks Content.' . "\n" . ' *' . "\n" . ' * @package Dynamik' . "\n" . ' */' . "\n" . "\n" . "\n" );

			fwrite($my_file, $contents);
			fclose($my_file);
			chmod($file, 0777);

			if( file_exists( $file ) ) {
				$handle = fopen( $file, 'w+' );
				fwrite( $handle, htmlspecialchars_decode( stripslashes( create_acf_block_template() ) ) );
				fclose( $handle );
			}
		}

	}




}