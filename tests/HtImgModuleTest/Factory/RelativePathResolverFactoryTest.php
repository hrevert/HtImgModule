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
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions);
        $serviceManager->setService('HtImgModule\Imagine\Resolver\ResolverManager', new ResolverManager);
        $factory = new RelativePathResolverFactory();
        $this->assertInstanceOf('Zend\View\Resolver\ResolverInterface', $factory->createService($serviceManager));
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
