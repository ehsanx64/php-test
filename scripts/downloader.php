<?php
function download($url, $filename) {
	$data = file_get_contents($url);
	file_put_contents(__DIR__ . "/$filename", $data);
}

function latestWordpress() {
	download("https://wordpress.org/latest.tar.gz", "latest.tar.gz");
}

latestWordpress();
