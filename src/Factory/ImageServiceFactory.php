<?php

namespace HtImgModule\Factory;

use HtImgModule\Imagine\Filter\FilterManager;
use HtImgModule\Imagine\Loader\LoaderManager;
use HtImgModule\Service\CacheManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Service\ImageService;

class ImageServiceFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var \Imagine\Image\ImagineInterface $imagine */
        $imagine            = $container->get('HtImg\Imagine');
        /** @var \HtImgModule\Service\CacheManagerInterface $cacheManager */
        $cacheManager       = $container->get(CacheManager::class);
        /** @var \HtImgModule\Imagine\Loader\LoaderManagerInterface $imageLoaderManager */
        $imageLoaderManager = $container->get(LoaderManager::class);
        /** @var \HtImgModule\Imagine\Filter\FilterManagerInterface $filterManager */
        $filterManager      = $container->get(FilterManager::class);

        return new ImageService($cacheManager, $imagine, $filterManager, $imageLoaderManager);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, ImageService::class);
    }
}
