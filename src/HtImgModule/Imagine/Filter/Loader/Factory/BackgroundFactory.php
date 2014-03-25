<?php
namespace HtImgModule\Imagine\Filter\Loader\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use HtImgModule\Imagine\Filter\Loader\Background;

class BackgroundFactory implements FactoryInterface
{
     public function createService(ServiceLocatorInterface $filterLoaders)
     {
         $serviceLocator = $filterLoaders->getServiceLocator();

         return new Background(
            $serviceLocator->get('HtImg\Imagine')
         );
     }
}
