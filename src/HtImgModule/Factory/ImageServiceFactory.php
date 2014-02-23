<?php

namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Service\ImageService;

class ImageServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $imagine = $serviceLocator->get('HtImg\Imagine');
        $options = $serviceLocator->get('HtImg\ModuleOptions');
        $cacheManager = $serviceLocator->get('HtImgModule\Service\CacheManager');
        $resolver = $serviceLocator->get('HtImg\RelativePathResolver');
        $filterManager = $serviceLocator->get('HtImgModule\Service\FilterManager');

        return new ImageService($cacheManager, $options, $imagine, $resolver, $filterManager);
    }
}
