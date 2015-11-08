<?php

use Phalcon\Di;

$di = new Di();
$di->setShared('config', function () {
    return [];
});
$di->setShared('connection', function () use ($di) {
    return null;
});
$di->setShared('logger', function () use ($di) {
    return null;
});
return $di;
