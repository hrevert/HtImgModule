<?php
namespace HtImgModule\Imagine\Resolver\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Resolver\ImagePathStackResolver;

class ImagePathStackResolverFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $resolvers)
    {
        $serviceLocator = $resolvers->getServiceLocator();
        $options = $serviceLocator->get('HtImg\ModuleOptions');

        return new ImagePathStackResolver([
            'script_paths' => $options->getImgSourcePathStack()
        ]);
    }
}
