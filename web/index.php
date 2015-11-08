<?php

use Phalcon\Http\Response;
use Phalcon\Mvc\Micro;

$root = dirname(__DIR__);
$loader = require $root . '/vendor/autoload.php';
$di = require $root . '/app/di.php';

try {
    $app = new Micro();
    $app->notFound(function () {
        return (new Response())->setStatusCode(404, 'Not Found');
    });
    $app->handle();
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error', true, 500);
}
