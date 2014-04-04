<?php
namespace HtImgModule\Imagine\Filter\Loader\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use HtImgModule\Imagine\Filter\Loader\Watermark;

class WatermarkFactory implements FactoryInterface
{
     public function createService(ServiceLocatorInterface $filterLoaders)
     {
         $serviceLocator = $filterLoaders->getServiceLocator();

         return new Watermark(
            $serviceLocator->get('HtImg\Imagine'),
            $serviceLocator->get('HtImg\RelativePathResolver')
         );
     }
}
