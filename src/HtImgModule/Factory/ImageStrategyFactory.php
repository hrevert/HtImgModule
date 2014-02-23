<?php

namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\View\Strategy\ImageStrategy;

class ImageStrategyFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $imagine = $serviceLocator->get('HtImg\Imagine');

        return new ImageStrategy($imagine);
    }
}
