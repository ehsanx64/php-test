<?php
session_start();

// Turn on errors
error_reporting(E_ALL);
ini_set('display_errors', true);

// Define some constants to make life easier
define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', dirname(dirname(__FILE__)));
define('CONFIG_DIR', BASE_DIR . DS . 'config');
define('LIB_DIR', BASE_DIR . DS . 'lib');
define('MODEL_DIR', BASE_DIR . DS . 'models');
define('CONTROLLER_DIR', BASE_DIR . DS . 'controllers');
define('VIEW_DIR', BASE_DIR . DS . 'views');
define('LAYOUT_DIR', BASE_DIR . DS . 'layout');
define('BASE_URL', 'http://locdev:8104');

require BASE_DIR . DS . 'vendor' . DS . 'autoload.php';
require LIB_DIR . DS . 'Controller.php';
require LIB_DIR . DS . 'Database.php';
require LIB_DIR . DS . 'Url.php';
require LIB_DIR . DS . 'Model.php';
$url = "http://locdev/module/controller/action";

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
$controllerFile = CONTROLLER_DIR . DS . ucfirst($get[0]) . '.php';
if (file_exists($controllerFile)) {
	// Include the controller file
	require $controllerFile;

	// Get name of controller
	$controllerName = ucfirst($get[0]) . 'Controller';

	// Instantiate controller class
	$controllerInstance = new $controllerName();

	// Get action name
	$controllerMethod = $get[1];

	// If a method with action name exists
	if (method_exists($controllerInstance, $controllerMethod)) {
		// Run the method (action)
		$controllerInstance->$controllerMethod();
	} else {
		// There is no such controller action
		die('Controller method not found');
	}
} else {
	// There is no such controller
	die('Controller not found');
}