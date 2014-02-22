<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Service\FilterManager;

class FilterManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('HtImg\ModuleOptions');
        $filterLoaderPluginManager = $serviceLocator->get('HtImgModule\Service\FilterLoaderPluginManager');

        return new FilterManager($options, $filterLoaderPluginManager);
    }
}
