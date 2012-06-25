<?php
// Routes
$app['route.path'] = APP_DIR . '/routes/';

// Databases
$app['db.config.driver']   = 'pdo_mysql';
$app['db.config.host']     = 'localhost';
$app['db.config.dbname']   = 'sample';
$app['db.config.user']     = 'sample';
$app['db.config.password'] = 'sample';

// Debug
$app['debug'] = false;

// Local
$app['locale'] = 'fr';
$app['session.default_locale'] = $app['locale'];
$app['translator.messages'] = array(
  'fr' => APP_DIR . '/resources/locales/fr.yml',
);

$app['video.tmp_path']   = APP_DIR . '/resources/tmp';

// Cache
$app['cache.path'] = APP_DIR . '/cache';

// Http cache
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';
