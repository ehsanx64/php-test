<?php
function p($string) {
	printf("<pre>%s</pre>", $string);
}

function d($what) {
	echo '<pre>';
	var_dump($what);
	echo '</pre>';
}

function dd($what) {
	d($what);
	die;
}
