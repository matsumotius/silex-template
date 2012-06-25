<?php
namespace Tmpl\Provider;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Silex\Application;
use Silex\ServiceProviderInterface;

class DoctrineORMProvider implements ServiceProviderInterface {

  public function addMapping(Application $app) {
    $app['em.mapping'] = $app->share(function () use ($app) {
      $config = new Configuration;
      return $config->newDefaultAnnotationDriver('AnnotationDriver');
    });
  }

  public function addConfig(Application $app) {
    $app['em.config'] = $app->share(function () use ($app) {
      $app['em.options'] = array_merge(
        array(
          'proxy_auto_generate' => $app['debug']
        ),
        isset($app['em.options']) ? $app['em.options'] : array()
      );
      $config = new Configuration;
      $config->setMetadataDriverImpl($app['em.mapping']);
      $config->setProxyDir($app['em.options']['proxy_dir']);
      $config->setProxyNamespace($app['em.options']['proxy_namespace']);
      return $config;
    });
  }

  public function addEntityManager(Application $app) {
    $app['em'] = $app->share(function () use ($app) {
      return EntityManager::create($app['db'], $app['em.config'], $app['db.event_manager']);
    });
  }

  public function boot (Application $app) {
  }

  public function register (Application $app) {
    $this->addMapping($app);
    $this->addConfig($app);
    $this->addEntityManager($app);
  }

}
