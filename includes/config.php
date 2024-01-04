<?php

// Needed for curl to verify the authenticity of the peer's certificate, etc.
define('DEBUG', false);

/*=========== Database Configuration ==========*/

//$baseUrl = 'localhost/tpweb/serverside/';
$baseUrl = 'https://teamplaycup.se/';
//$baseUrl = 'https://89.221.249.123/';
//$baseUrl = '../';

$layout = '1';
$lang = 'swe';

//$useCache = false;
//$cacheTime = 60;

/*=========== Website Configuration ==========*/

$defaultTitle = 'Teamplay Web';
$version = "v2.2";
$introText = "Tool for tournaments";
$defaultFooter = $defaultTitle . " " . ' &copy; Mibosoft';
