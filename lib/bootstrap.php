<?php
session_start();

// Turn on errors
error_reporting(E_ALL);
ini_set('display_errors', true);

// Define some constants to make life easier
define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', dirname(dirname(__FILE__)));
define('BASE_URL', 'http://locdev:8104');
define('CONFIG_DIR', BASE_DIR . DS . 'config');
define('LIB_DIR', BASE_DIR . DS . 'lib');
define('MODEL_DIR', BASE_DIR . DS . 'models');
define('CONTROLLER_DIR', BASE_DIR . DS . 'controllers');
define('VIEW_DIR', BASE_DIR . DS . 'views');
define('LAYOUT_DIR', BASE_DIR . DS . 'layout');

require BASE_DIR . DS . 'vendor' . DS . 'autoload.php';
require LIB_DIR . DS . 'Utility.php';
require LIB_DIR . DS . 'Controller.php';
require LIB_DIR . DS . 'Database.php';
require LIB_DIR . DS . 'Url.php';
require LIB_DIR . DS . 'Model.php';

// Get routing parameters
if (isset($_GET['r'])) {
	$chopped = explode('/', $_GET['r']);
	if (count($chopped) <= 1) {
		$get[] = $chopped[0];
	} else {
		$get = $chopped;
	}
} else {
	$get = array(
		'site',
		'index'
	);
}

// If no controller specified use default
if (!isset($get[0]) || empty($get[0])) {
	$get[0] = 'site';
}

// If no action specified use default
if (!isset($get[1]) || empty($get[1])) {
	$get[1] = 'index';
}

// Construct controller path
// We need to check for hyphens in controller part
if (strpos($get[0], '-') >= 0) {
	$cparts = explode('-', $get[0]);
	$controller = ucfirst($cparts[0]);

	for ($i = 1; $i < count($cparts); $i++) {
		$controller .= ucfirst($cparts[$i]);
	}
} else {
	$controller = ucfirst($get[0]);
}

$controllerFile = CONTROLLER_DIR . DS . $controller . '.php';

if (file_exists($controllerFile)) {
	// Include the controller file
	require $controllerFile;

	// Get name of controller
	$controllerName = $controller . 'Controller';

	// Instantiate controller class
	$controllerInstance = new $controllerName();

	// Get action name
	// We need to check for hyphens in action part as well
	if (strpos($get[1], '-') >= 0) {
		$aparts = explode('-', $get[1]);
		$method = $aparts[0];

		for ($i = 1; $i < count($aparts); $i++) {
			$method .= ucfirst($aparts[$i]);
		}
	} else {
		$method = $get[1];
	}

	// If a method with action name exists
	if (method_exists($controllerInstance, $method)) {
		// Run the method (action)
		$controllerInstance->$method();
	} else {
		// There is no such controller action
		die('Controller method not found');
	}
} else {
	// There is no such controller
	die('Controller not found');
}
