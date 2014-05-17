<?php
namespace HtImgModule\Factory\Imagine\Loader;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Loader\LoaderPluginManager;

class LoaderPluginManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new LoaderPluginManager($serviceLocator->get('Config')['htimg']['loaders']);
    }
}
