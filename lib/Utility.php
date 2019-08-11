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

function jsonReturn($data) {
	die(json_encode([
		'result' => true,
		'data' => $data
	]));
}

function jsonError($data) {
	die(json_encode([
		'result' => false,
		'data' => $data
	]));
}