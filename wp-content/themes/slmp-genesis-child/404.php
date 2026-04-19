<?php
/*
 * Include 404 Page
*/

$notFound 	= SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-404-page.php';

if ( is_file($notFound) ) {
    require_once $notFound;
}