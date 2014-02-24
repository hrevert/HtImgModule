<?php
namespace HtImgModuleTest\Factory;

use Zend\ServiceManager\ServiceManager;
use Imagine\Gd\Imagine;
use HtImgModule\Factory\ImageStrategyFactory;

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
