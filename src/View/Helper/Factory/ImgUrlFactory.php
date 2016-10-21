<?php
namespace HtImgModule\View\Helper\Factory;

use HtImgModule\Imagine\Filter\FilterManager;
use HtImgModule\Imagine\Loader\LoaderManager;
use HtImgModule\Service\CacheManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use HtImgModule\View\Helper\ImgUrl;

class ImgUrlFactory implements FactoryInterface
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
        if (!method_exists($container, 'configure')) {
            $container = $container->getServiceLocator();
        }

        return new ImgUrl(
            $container->get(CacheManager::class),
            $container->get(FilterManager::class),
            $container->get(LoaderManager::class)
        );
    }

    public function createService(ServiceLocatorInterface $helpers)
    {
        return $this($helpers, ImgUrl::class);
    }
}
