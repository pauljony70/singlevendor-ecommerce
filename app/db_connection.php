<?php
// header ('Content-Type: text/html; charset=UTF-8');

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

date_default_timezone_set('Asia/Kolkata');

define('HOST', 'localhost');
define('DB1', 'singlevendor');
define('USER', 'root');
define('PASS', '');

$OTPauthKey = "";

$serverkey = "AAAAcxFB1SWsdfsdf834hfnNeT";

define('APP_NAME', 'singlevendor');
define('BASEURL', 'http://localhost/singlevendor-ecommerce/');
define('MEDIA_URL', 'http://localhost/singlevendor-ecommerce/media/');
// define('BASEURL', 'https://reshamdhaage.com/');
// define('MEDIA_URL', 'https://reshamdhaage.com/media/');

$g_mail = "info@mkkirana.com";
$senderid = "mkkirana";

$conn = new mysqli(HOST, USER, PASS, DB1);


if ($conn->connect_errno) {
	trigger_error('Database connection has failed ' . $conn->connect_errno, E_USER_ERROR);
}
