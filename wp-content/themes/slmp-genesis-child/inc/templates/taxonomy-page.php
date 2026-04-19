<?php
/*
* Generate Taxonomy
*/

function create_taxonomy() {
	if ( function_exists('acf_add_options_page') ) {

		$taxonomys = get_field('taxonomy_generator', 'options');

		/* Delete Old Templates */
		$template_folder = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-taxonomy/';
		$all_files 	= glob(SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-taxonomy/*');

		if ( $all_files ) {
			foreach ( $all_files as $old_file) {
				if(is_file($old_file)) {
				    unlink($old_file);
				}
			}
		}

		/* Create new Templates */
		if ( $taxonomys ) {

			foreach ( $taxonomys as $taxonomy ) {
				$template_content = '';
				$template_content .= '<?php'. "\n";
				$template_content .= '/*'. "\n";
				$template_content .= ' * Taxonomy Name: '. $taxonomy['taxonomy_name'] .''. "\n";
				$template_content .= '*/'. "\n";
				$template_content .= '?>'. "\n";
				$template_content .= "\n";
				$template_content .= "\n";

				$file 		= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/slmp-custom-taxonomy/'. $taxonomy['taxonomy_filename'] .'.php';
				$my_file 	= fopen($file,'w');
				$template_content 	.= $taxonomy['taxonomy_content'];

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