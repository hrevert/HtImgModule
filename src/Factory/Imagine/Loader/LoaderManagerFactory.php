<?php
namespace HtImgModule\Factory\Imagine\Loader;

use HtImgModule\Binary\MimeTypeGuesser;
use HtImgModule\Imagine\Filter\FilterManager;
use HtImgModule\Imagine\Loader\LoaderPluginManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Loader\LoaderManager;

class LoaderManagerFactory implements FactoryInterface
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
        $filterManager      = $container->get(FilterManager::class);
        $imageLoaders       = $container->get(LoaderPluginManager::class);
        $defaultImageLoader = $container->get('HtImg\ModuleOptions')->getDefaultImageLoader();
        $mimeTypeGuesser    = $container->get(MimeTypeGuesser::class);

        return new LoaderManager($imageLoaders, $filterManager, $defaultImageLoader, $mimeTypeGuesser);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, LoaderManager::class);
    }
}
