<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Options\ModuleOptions;

class ModuleOptionsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ModuleOptions($serviceLocator->get('Config')['htimg']);
    }
}
