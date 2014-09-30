<?php

namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Service\ImageService;

class ImageServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Imagine\Image\ImagineInterface $imagine */
        $imagine            = $serviceLocator->get('HtImg\Imagine');

        /** @var \HtImgModule\Service\CacheManagerInterface $cacheManager */
        $cacheManager       = $serviceLocator->get('HtImgModule\Service\CacheManager');

        /** @var \HtImgModule\Imagine\Loader\LoaderManagerInterface $imageLoaderManager */
        $imageLoaderManager = $serviceLocator->get('HtImgModule\Imagine\Loader\LoaderManager');

        /** @var \HtImgModule\Imagine\Filter\FilterManagerInterface $filterManager */
        $filterManager      = $serviceLocator->get('HtImgModule\Imagine\Filter\FilterManager');

        $imageService       = new ImageService($cacheManager, $imagine, $filterManager, $imageLoaderManager);

        return $imageService;
    }
}
