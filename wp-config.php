<?php
define('DB_NAME',     getenv('MYSQLDATABASE') ?: 'stormhelppro');
define('DB_USER',     getenv('MYSQLUSER')     ?: 'root');
define('DB_PASSWORD', getenv('MYSQLPASSWORD') ?: '');
define('DB_HOST',     (getenv('MYSQLHOST') ?: 'localhost') . ':' . (getenv('MYSQLPORT') ?: '3306'));
define('DB_CHARSET',  'utf8');
define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
define('DB_COLLATE',  '');

define('AUTH_KEY',         'S}A#G?ZdL=2A!||3q=sn~+!(<ZL-5HG6AJgL$y`-S@p^F|kj,$20K{:ectn;P|6C');
define('SECURE_AUTH_KEY',  'AmSgy(j8M*IKmJ^m;k]%Q,NEu^zYAZbU6_w>>E!:R0O-9M])?nRl#&mxY$2leu!{');
define('LOGGED_IN_KEY',    '.)n`vb4,&zJ<~-j2[@@p-fv2+hybe;@XEm=;9SLa*+$<O8C|yvWfvS[_.o^8i%SY');
define('NONCE_KEY',        'wQ~_f_gC|(Zrx[7>6SDsiM=Kejdm~=C9%R7+(7p87rlZMzZiS./io++De[6-UdUr');
define('AUTH_SALT',        'y/>-|r#A[sUO:&]16$Tp%>wu1}9u|q5nx6BW0nWV,e43w[~`H|9@wWg-3`gd@(C+');
define('SECURE_AUTH_SALT', '_swyV57R?@N^NrlDZx{fn/?Y?5;Ix1p5*<%=R;(mqp@s=gAz,/)AYgV]Y&BWaCGs');
define('LOGGED_IN_SALT',   'l3;r-Y9$YwVUe,3RMUT0NlCZiB-M))8[}C(%FE/WHgdFA0| [[L$xrp/Rdy.*cPW');
define('NONCE_SALT',       '8~l,+HTqgCqL_ZYXa]44!$V~87Iq0iQN nnODx3Y/s6?wf=~B=3b;-o3<JX<o#_s');

$table_prefix = 'wp_';

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$siteurl  = $protocol . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
define('WP_HOME',    $siteurl);
define('WP_SITEURL', $siteurl);

define('WP_DEBUG', false);

if (!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');
