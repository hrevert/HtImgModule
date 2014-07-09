<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Resolver\ResolverManager;
use Zend\ServiceManager\Config;

class ResolverManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config          = new Config($serviceLocator->get('Config')['htimg']['resolvers_manager']);
        $resolverManager = new ResolverManager($config);
        $resolverManager->setServiceLocator($serviceLocator);

        return $resolverManager;
    }
}
