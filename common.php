<?php
session_start ();
//header('Content-type: text/html; charset=windows-1252');
header("Access-Control-Allow-Origin: *");
header ("Cache-control: private"); // IE 6 FIX

// Language
if (isSet ( $_GET ['lang'] )) {
	$lang = $_GET ['lang'];
	
	// register the session and set the cookie
	$_SESSION ['lang'] = $lang;

//	setcookie ( 'lang', $lang, time () + (3600 * 24 * 30) );
} else if (isSet ( $_SESSION ['lang'] )) {
	$lang = $_SESSION ['lang'];
} else if (isSet ( $_COOKIE ['lang'] )) {
	$lang = $_COOKIE ['lang'];
} else {
	$lang = 'swe';
}

switch ($lang) {
	case 'eng' :
		$lang_file = 'eng.php';
		break;
	
	case 'fin' :
		$lang_file = 'fin.php';
		break;
	
	case 'nor' :
		$lang_file = 'nor.php';
		break;
	
	case 'cze' :
	    $lang_file = 'cze.php';
//	    header('Content-type: text/html; charset=windows-1252');
	    break;
	
	default :
		$lang_file = 'swe.php';
}

include_once 'translations/' . $lang_file;

// Layout
if (isSet ( $_GET ['layout'] )) {
	$layout = $_GET ['layout'];
	
	// register the session and set the cookie
	$_SESSION ['layout'] = $layout;
	
//	setcookie ( 'layout', $layout, time () + (3600 * 24 * 30) );
} else if (isSet ( $_SESSION ['layout'] )) {
	$layout = $_SESSION ['layout'];
} else if (isSet ( $_COOKIE ['layout'] )) {
	$layout = $_COOKIE ['layout'];
} else {
	$layout = '1';
}

?>