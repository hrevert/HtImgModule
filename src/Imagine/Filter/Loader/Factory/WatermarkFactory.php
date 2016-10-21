<?php
namespace HtImgModule\Imagine\Filter\Loader\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use HtImgModule\Imagine\Filter\Loader\Watermark;

class WatermarkFactory implements FactoryInterface
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
        // For v2, we need to pull the parent service locator
        if (!method_exists($container, 'configure')) {
            $container = $container->getServiceLocator() ?: $container;
        }

        return new Watermark(
            $container->get('HtImg\Imagine'),
            $container->get('HtImg\RelativePathResolver')
        );
    }

     public function createService(ServiceLocatorInterface $filterLoaders)
     {
        return $this($filterLoaders, Watermark::class);
     }
}
