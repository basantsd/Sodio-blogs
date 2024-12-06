<?php

use App\Core\Router;

error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Asia/Kolkata');
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../config.php';


$router = new Router();
require BASE_PATH . '/app/routes.php';
registerRoutes($router);  // Call the function to register routes

// Get the base directory of the script being executed, relative to the document root
$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

// Get the request URI and remove the base directory from it
$requestUri = str_replace($baseDir, '', $_SERVER['REQUEST_URI']);

// Remove query string from the request URI
$requestUri = explode('?', $requestUri)[0];
define('CURRENT_URL',$requestUri);

// Dispatch the cleaned URI
$router->dispatch($requestUri);
