<?php
/**
 * Front controller
 *
 * PHP version 7.0
 */
/**
 * Composer
 */
require __DIR__ . '/vendor/autoload.php';
/**
 * Twig
 */
Twig_Autoloader::register();
/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');
/**
 * Routing
 */
$router = new Core\Router();
// Add the routes
$router->add('', ['controller' => 'SmartMirrorController', 'action' => 'index']);
$router->add('news', ['controller' => 'NewsController', 'action' => 'index']);
$router->add('reminders', ['controller' => 'ReminderController', 'action' => 'index']);

$router->dispatch($_SERVER['QUERY_STRING']);