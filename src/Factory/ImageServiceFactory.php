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
        $imageLoaderManager = $serviceLocator->get('HtImgModule\Imagine\Loader\LoaderManager');
        $filterManager = $serviceLocator->get('HtImgModule\Imagine\Filter\FilterManager');

        $imageService = new ImageService($options, $imagine, $filterManager, $imageLoaderManager);
        if ($options->getEnableCache()) {
            $imageService->setCacheManager($serviceLocator->get('HtImgModule\Service\CacheManager'));
        }

        return $imageService;
    }
}
