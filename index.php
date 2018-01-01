<?php

require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$app = new \Core\Application();
$app->run();

