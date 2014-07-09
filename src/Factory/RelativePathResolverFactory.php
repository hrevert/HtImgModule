<?php
namespace HtImgModule\Factory;

use HtImgModule\Imagine\Resolver\AggregateResolver;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RelativePathResolverFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options         = $serviceLocator->get('HtImg\ModuleOptions');
        $resolver        = new AggregateResolver();
        $resolverManager = $serviceLocator->get('HtImgModule\Imagine\Resolver\ResolverManager');
        foreach ($options->getImageResolvers() as $priority => $subResolverName) {
            $resolver->attach($resolverManager->get($subResolverName), $priority);
        }

        return $resolver;
    }
}
