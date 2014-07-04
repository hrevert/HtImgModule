<?php
namespace HtImgModule\Factory\Imagine\Loader;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Loader\LoaderManager;

class LoaderManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $filterManager      = $serviceLocator->get('HtImgModule\Imagine\Filter\FilterManager');
        $imageLoaders       = $serviceLocator->get('HtImgModule\Imagine\Loader\LoaderPluginManager');
        $defaultImageLoader = $serviceLocator->get('HtImg\ModuleOptions')->getDefaultImageLoader();
        $mimeTypeGuesser    = $serviceLocator->get('HtImgModule\Binary\MimeTypeGuesser');

        return new LoaderManager($imageLoaders, $filterManager, $defaultImageLoader, $mimeTypeGuesser);
    }
}
