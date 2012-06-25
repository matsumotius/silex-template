<?php
if (false == defined('NISEVIDEO_MODE')) {
  define('NISEVIDEO_MODE', 'developement');
}
if (false == defined('APP_DIR')) {
  define('APP_DIR', __DIR__);
}
$loader = require_once APP_DIR. '/vendor/autoload.php';
$loader->add('Nisevideo', APP_DIR. '/src');
