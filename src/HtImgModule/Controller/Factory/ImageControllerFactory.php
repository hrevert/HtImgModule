<?php
namespace HtImgModule\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Controller\ImageController;

class ImageControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllers)
    {
        $serviceLocator = $controllers->getServiceLocator();

        return new ImageController($serviceLocator->get('HtImgModule\Service\ImageService'));
    }
}
