<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager;
use Zend\ServiceManager\Config;

class FilterLoaderPluginManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options       = $serviceLocator->get('HtImg\ModuleOptions');
        $pluginManager = new FilterLoaderPluginManager(new Config($options->getFilterLoaders()));
        $pluginManager->setServiceLocator($serviceLocator);

        return $pluginManager;
    }
}
