<?php
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

define('APPLICATION_ROOT', __DIR__);
define('CONFIG_ROOT', __DIR__ . '/App/Configs/');

$application = new \Core\Application();