<?php
/**
 * boostrap application
 */
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\MonologServiceProvider;

use Symfony\Component\Translation\Loader\YamlFileLoader;

$app = new Silex\Application();

if (NISEVIDEO_MODE === 'test') {
  require APP_DIR . '/tests/config.php';
} else {
  require APP_DIR . '/scripts/config.php';
}

$app->register(new HttpCacheServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new UrlGeneratorServiceProvider());

$app->register(new TranslationServiceProvider(), array(
  'local' => $app['locale'],
  'translator.domains' => array(
    'messages' => array(
      'fr' => APP_DIR . '/resources/locales/fr.yml',
    )
  )
));
$app['translator.loader'] = $app->share(function () {
  return new YamlFileLoader();
});

$app->register(new MonologServiceProvider(), array(
  'monolog.logfile' => APP_DIR . '/log/app.log',
  'monolog.name'    => 'app',
  'monolog.level'   => 300 // = Logger::WARNING
));

$app->register(new TwigServiceProvider(), array(
  'twig.options'        => array('cache' => false, 'strict_variables' => true),
  'twig.path'           => array(APP_DIR . '/views')
));

$app->register(new DoctrineServiceProvider(), array(
  'db.options' => array(
    'driver'    => $app['db.config.driver'],
    'dbname'    => $app['db.config.dbname'],
    'host'      => $app['db.config.host'],
    'user'      => $app['db.config.user'],
    'password'  => $app['db.config.password'],
  )
));

// Temporary hack. Silex should start session on demand.
$app->before(function() use ($app) {
  $app['session']->start();
});

return $app;
