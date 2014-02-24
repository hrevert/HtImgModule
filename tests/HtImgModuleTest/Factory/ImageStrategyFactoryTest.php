<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\ImageStrategyFactory;
use Imagine\Gd\Imagine;

class ImageStrategyFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\Imagine', new Imagine);
        $factory = new ImageStrategyFactory();
        $this->assertInstanceOf('HtImgModule\View\Strategy\ImageStrategy', $factory->createService($serviceManager)); 
    }
}
