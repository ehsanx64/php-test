<?php
// Configuration
define('BASE_URL', 'http://php-test.local:8104');
define('DS', DIRECTORY_SEPARATOR);

// Include composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Utility functions
function getUrl($url) {
    return BASE_URL . '/' . $url;
}