<?php
namespace HtImgModuleTest\Imagine\Filter\Loader\Factory;

use HtImgModule\Imagine\Filter\Loader\Factory\WatermarkFactory;
use Zend\ServiceManager\ServiceManager;
use Imagine\Gd\Imagine;

class WatermarkFactoryTest extends \PHPUnit_Framework_Testcase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager;
        $serviceManager->setService('HtImg\Imagine', new Imagine);
        $serviceManager->setService('HtImg\RelativePathResolver', $this->getMock('Zend\View\Resolver\ResolverInterface'));
        $loaders = $this->getMock('Zend\ServiceManager\AbstractPluginManager');
        $loaders->expects($this->any())
            ->method('getServiceLocator')
           ->will($this->returnValue($serviceManager));
        $factory = new WatermarkFactory();
        $loader = $factory->createService($loaders);
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Loader\Watermark', $loader);
    }
}
