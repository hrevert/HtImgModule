<?php
namespace HtImgModuleTest\Imagine\Resolver\Factory;

use HtImgModule\Imagine\Resolver\Factory\ImageMapResolverFactory;
use Zend\ServiceManager\ServiceManager;
use HtImgModule\Options\ModuleOptions;

class ImageMapResolverFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager;
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions);
        $factory = new ImageMapResolverFactory;
        $resolvers = $this->getMockBuilder('HtImgModule\Imagine\Resolver\ResolverManager')
            ->disableOriginalConstructor()
            ->getMock();
        if (!method_exists($serviceManager, 'configure')) {
            $resolvers->expects($this->once())
                ->method('getServiceLocator')
                ->will($this->returnValue($serviceManager));
        } else {
            $resolvers = $serviceManager;
        }
        $this->assertInstanceOf('HtImgModule\Imagine\Resolver\ImageMapResolver', $factory->createService($resolvers));
    }
}
