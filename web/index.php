<?php
require_once __DIR__.'/../bootstrap.php';
require __DIR__.'/../scripts/app.php';
require __DIR__.'/../scripts/routes.php';

if ($app['debug']) {
    return $app->run();
}

$app['http_cache']->run();
