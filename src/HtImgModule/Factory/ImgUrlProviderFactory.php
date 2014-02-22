<?php

namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Service\ImgUrlProvider;

class ImgUrlProviderFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('HtImg\ModuleOptions');

        return new ImgUrlProvider($options);
    }
}
