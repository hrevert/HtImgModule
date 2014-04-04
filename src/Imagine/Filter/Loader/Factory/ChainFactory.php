<?php

namespace HtImgModule\Imagine\Filter\Loader\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use HtImgModule\Imagine\Filter\Loader\Chain;

class ChainFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $filterLoaders)
    {
        $serviceLocator = $filterLoaders->getServiceLocator();

        return new Chain($serviceLocator->get('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager'));
    }
}
