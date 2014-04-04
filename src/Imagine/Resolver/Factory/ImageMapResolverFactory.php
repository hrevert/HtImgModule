<?php
namespace HtImgModule\Imagine\Resolver\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Resolver\ImageMapResolver;

class ImageMapResolverFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $resolvers)
    {
        $serviceLocator = $resolvers->getServiceLocator();
        $options = $serviceLocator->get('HtImg\ModuleOptions');

        return new ImageMapResolver($options->getImgSourceMap());
    }
}
