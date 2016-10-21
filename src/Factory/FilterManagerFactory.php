<?php
namespace HtImgModule\Factory;

use HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Filter\FilterManager;

class FilterManagerFactory implements FactoryInterface
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
        /** @var \HtImgModule\Options\FilterOptionsInterface $options */
        $options                    = $container->get('HtImg\ModuleOptions');

        /** @var ServiceLocatorInterface $filterLoaderPluginManager */
        $filterLoaderPluginManager  = $container->get(FilterLoaderPluginManager::class);

        return new FilterManager($options, $filterLoaderPluginManager);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, FilterManager::class);
    }
}
