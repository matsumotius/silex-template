<?php

$route_dir = opendir($app['route.path']);
while ($filename = readdir($route_dir)) {
  if (preg_match('/.*\.php$/', $filename)) {
    require_once $app['route.path'] . $filename;
  }
}
