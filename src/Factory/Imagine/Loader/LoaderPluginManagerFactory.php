<?php
namespace HtImgModule\Factory\Imagine\Loader;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Config;
use HtImgModule\Imagine\Loader\LoaderPluginManager;

class LoaderPluginManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new LoaderPluginManager(new Config($serviceLocator->get('Config')['htimg']['loaders']));
    }
}
