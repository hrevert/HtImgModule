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
        $resolvers = $this->getMock('HtImgModule\Imagine\Resolver\ResolverManager');
        $resolvers->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($serviceManager));
        $this->assertInstanceOf('HtImgModule\Imagine\Resolver\ImageMapResolver', $factory->createService($resolvers));
    }
}
