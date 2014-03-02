<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Resolver\ResolverManager;

class ResolverManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $resolverManager = new ResolverManager($serviceLocator->get('Config')['resolvers_manager']);
        $resolverManager->setServiceLocator($serviceLocator);

        return $resolverManager;
    }
}
