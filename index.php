<?php

require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
set_error_handler('Core\Error\ErrorHandler::errorHandler');
set_exception_handler('Core\Error\ErrorHandler::exceptionHandler');

define('APPLICATION_ROOT', __DIR__);
define('CONFIG_ROOT', __DIR__ . '/App/Configs/');

$application = new \Core\Application();
$application->run();

session_start();