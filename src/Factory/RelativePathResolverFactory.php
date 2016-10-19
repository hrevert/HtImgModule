<?php
namespace HtImgModule\Factory;

use HtImgModule\Imagine\Resolver\AggregateResolver;
use HtImgModule\Imagine\Resolver\ResolverManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RelativePathResolverFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return AggregateResolver
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options         = $container->get('HtImg\ModuleOptions');
        $resolver        = new AggregateResolver();
        $resolverManager = $container->get(ResolverManager::class);
        foreach ($options->getImageResolvers() as $priority => $subResolverName) {
            $resolver->attach($resolverManager->get($subResolverName), $priority);
        }

        return $resolver;
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, AggregateResolver::class);
    }
}
