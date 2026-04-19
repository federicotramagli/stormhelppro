<?php
/*
 * Include Search Page
*/

$search = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-search-page.php';

if ( is_file($search) ) {
    require_once $search;
}