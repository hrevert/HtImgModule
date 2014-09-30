<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Filter\FilterManager;

class FilterManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \HtImgModule\Options\FilterOptionsInterface $options */
        $options                    = $serviceLocator->get('HtImg\ModuleOptions');
        
        /** @var ServiceLocatorInterface $filterLoaderPluginManager */
        $filterLoaderPluginManager  = $serviceLocator->get('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager');

        return new FilterManager($options, $filterLoaderPluginManager);
    }
}
