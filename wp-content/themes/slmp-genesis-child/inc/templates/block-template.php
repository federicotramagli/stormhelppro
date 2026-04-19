<?php
/*
* Generate ACF Block Templates
*/

function create_acf_block_template() {
	if ( function_exists('acf_add_options_page') ) {

		$dynamik_acf_blocks = '<?php' . "\n" . '/**' . "\n" . ' * Build Custom ACF Blocks Content.' . "\n" . ' *' . "\n" . ' * @package Dynamik' . "\n" . ' */' . "\n" . "\n" . "\n";
		$contents = get_field('acf_block_template_generator', 'options');
		$single_quote 		= "'";


		if ( $contents ) {
			foreach ( $contents as $value ) {
				$name 				= $value['acf_block_name'];
				$function_name 		= $value['acf_block_filename'];
				$content 			= $value['acf_block_content'];

				$dynamik_acf_blocks .= '/* Name: ' . $name . ' */' . "\n";
				$dynamik_acf_blocks .= 'function '. $function_name .'() { ?>'. "\n";
				$dynamik_acf_blocks .= "\n";
				$dynamik_acf_blocks .= "\t" .''. $content  .''. "\n";
				$dynamik_acf_blocks .= "\n";
				$dynamik_acf_blocks .= '<?php }' . "\n";
				$dynamik_acf_blocks .= "\n";
				$dynamik_acf_blocks .= "\n";
			}

		}

		return html_entity_decode($dynamik_acf_blocks);

	}
}