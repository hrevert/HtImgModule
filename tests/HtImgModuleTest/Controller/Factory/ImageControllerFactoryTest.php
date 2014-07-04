<?php
namespace HtImgModuleTest\Controller\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Controller\Factory\ImageControllerFactory;
use Zend\Mvc\Controller\ControllerManager;

class ImageControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImgModule\Service\ImageService', $this->getMock('HtImgModule\Service\ImageServiceInterface'));
        $factory = new ImageControllerFactory();
        $controllers = new ControllerManager;
        $controllers->setServiceLocator($serviceManager);
        $this->assertInstanceOf('HtImgModule\Controller\ImageController', $factory->createService($controllers));
    }
}
