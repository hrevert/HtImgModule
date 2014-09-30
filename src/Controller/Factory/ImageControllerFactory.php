<?php
namespace HtImgModule\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Controller\ImageController;

class ImageControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllers)
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $controllers->getServiceLocator();

        /** @var \HtImgModule\Service\ImageService $imageService */
        $imageService = $serviceLocator->get('HtImgModule\Service\ImageService');

        return new ImageController($imageService);
    }
}
