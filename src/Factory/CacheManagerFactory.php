<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Service\CacheManager;

class CacheManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \HtImgModule\Options\CacheOptionsInterface $options */
        $options = $serviceLocator->get('HtImg\ModuleOptions');

        return new CacheManager($options);
    }
}
