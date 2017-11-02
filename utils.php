<?php
// Configuration
define('BASE_URL', 'http://localhost/phplay');
define('DS', DIRECTORY_SEPARATOR);

// Include composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Utility functions
function getUrl($url) {
    return BASE_URL . '/' . $url;
}