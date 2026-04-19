<?php
/*
 * Include Archive Page
*/

$archive = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-archive-page.php';

if ( is_file($archive) ) {
    require_once $archive;
}