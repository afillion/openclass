<?php

function debug($var) {
	echo '<pre>' , print_r($var, true) , '</pre>';
}

function str_random($len) {
	$a = "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
	return substr(str_shuffle(str_repeat($a, $len)), 0, $len);
}