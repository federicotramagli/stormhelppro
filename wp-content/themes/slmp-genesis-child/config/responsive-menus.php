<?php
/**
 * SFL Blaze child theme.
 *
 * @package SFL Blaze
 * @author  Web Dev Team
 * @license GPL-2.0-or-later
 * @link    https://www.surefirelocal.com/
 */

/**
 * Genesis responsive menus settings. (Requires Genesis 3.0+.)
 */
return [
	'script' => [
		'mainMenu'    => __( '', 'sfl-blaze' ),
		'menuClasses' => [
			 'others' => [ '.nav-primary' ],
		],
	],
	'extras' => [
		'media_query_width' => '1023px',
	],
];
