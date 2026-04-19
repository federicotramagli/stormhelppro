<?php
/*
 * Include Archive Page
*/

$single = SLMP_THEME_UPLOAD_DIR . '/slmp-dynamic-gen/dynamic-custom-single-post.php';

if ( is_file($single) ) {
    require_once $single;
}