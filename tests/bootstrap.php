<?php
if (false == defined('NISEVIDEO_MODE')) {
  define('NISEVIDEO_MODE', 'test');
}
if (false == defined('APP_DIR')) {
  define('APP_DIR', dirname(__DIR__));
}
$loader = require_once APP_DIR. '/vendor/autoload.php';
$loader->add('Nisevideo', APP_DIR. '/src');

// load NisevideoTestCase
include_once 'NisevideoTestCase.php';
