<?php
/*
* Generate Templates
*/

function create_template() {
	if ( function_exists('acf_add_options_page') ) {

		$templates = get_field('template_generator', 'options');

		/* Delete Old Templates */
		$template_folder = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-templates/';
		$all_files 	= glob(SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-templates/*');

		if ( $all_files ) {
			foreach ( $all_files as $old_file) {
				if(is_file($old_file)) {
				    unlink($old_file);
				}
			}
		}

		/* Create new Templates */
		if ( $templates ) {

			foreach ( $templates as $template ) {
				$template_content = '';
				$template_content .= '<?php'. "\n";
				$template_content .= '/*'. "\n";
				$template_content .= ' * Template Name: '. $template['template_name'] .''. "\n";
				$template_content .= '*/'. "\n";
				$template_content .= '?>'. "\n";
				$template_content .= "\n";
				$template_content .= "\n";

				$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-templates/'. $template['template_filename'] .'.php';
				$my_file 	= fopen($file,'w');
				$template_content 	.= $template['template_content'];

				fwrite($my_file, $template_content);
				fclose($my_file);
				chmod($file, 0777);

				if( file_exists( $file ) ) {
					$handle = fopen( $file, 'w+' );
					fwrite( $handle, $template_content );
					fclose( $handle );
				}

			}

			return html_entity_decode($template_content);

		}

	}
}