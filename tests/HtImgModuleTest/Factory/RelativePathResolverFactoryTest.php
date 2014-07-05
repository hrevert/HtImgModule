<?php

namespace HtImgModuleTest\Factory;

use HtImgModule\Factory\RelativePathResolverFactory;
use Zend\ServiceManager\ServiceManager;
use HtImgModule\Options\ModuleOptions;
use HtImgModule\Imagine\Resolver\ResolverManager;

class RelativePathResolverFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $options = new ModuleOptions;
        $options->setImageResolvers([1000 => 'image_map']);
        $serviceManager->setService('HtImg\ModuleOptions', $options);
        $resolverManager = $this->getMock('HtImgModule\Imagine\Resolver\ResolverManager');
        $resolverManager->expects($this->once())
            ->method('get')
            ->will($this->returnValue($this->getMock('Zend\View\Resolver\ResolverInterface')));
        $serviceManager->setService('HtImgModule\Imagine\Resolver\ResolverManager', $resolverManager);
        $factory = new RelativePathResolverFactory();
        $this->assertInstanceOf('HtImgModule\Imagine\Resolver\AggregateResolver', $factory->createService($serviceManager));
    }

    public function testResolve()
    {
        $serviceManager = new ServiceManager();
        $options = new ModuleOptions;
        $serviceManager->setService('HtImg\ModuleOptions', $options);
        $resolverManager = new ResolverManager;
        $resolverManager->setServiceLocator($serviceManager);
        $serviceManager->setService('HtImgModule\Imagine\Resolver\ResolverManager', $resolverManager);
        $factory = new RelativePathResolverFactory();
        $resolver = $factory->createService($serviceManager);
        $this->assertEquals(false, $resolver->resolve('hello'));
        $stackResolver = $resolverManager->get('image_path_stack');
        $stackResolver->setPaths([__DIR__]);
        $this->assertEquals(realpath(__DIR__ . '/RelativePathResolverFactoryTest.php'), $stackResolver->resolve('RelativePathResolverFactoryTest.php'));
    }
}
