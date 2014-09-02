<?php

namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Service\ImageService;

class ImageServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $imagine            = $serviceLocator->get('HtImg\Imagine');
        $cacheManager       = $serviceLocator->get('HtImgModule\Service\CacheManager');
        $imageLoaderManager = $serviceLocator->get('HtImgModule\Imagine\Loader\LoaderManager');
        $filterManager      = $serviceLocator->get('HtImgModule\Imagine\Filter\FilterManager');
        $imageService       = new ImageService($cacheManager, $imagine, $filterManager, $imageLoaderManager);

        return $imageService;
    }
}
