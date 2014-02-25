<?php

namespace HtImgModuleTest\Factory;

use HtImgModule\Factory\RelativePathResolverFactory;
use Zend\ServiceManager\ServiceManager;
use HtImgModule\Options\ModuleOptions;

class RelativePathResolverFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $resolver;

    protected $factory;

    public function SetUp()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions);
        $factory = new RelativePathResolverFactory();
        $this->factory = $factory;
        $this->resolver = $factory->createService($serviceManager);
    }

    public function testFactory()
    {
        $this->assertInstanceOf('Zend\View\Resolver\AggregateResolver', $this->resolver);
    }

    public function testResolve()
    {
        $this->assertEquals(false, $this->resolver->resolve('hello'));
        $stackResolver = $this->factory->getStackResolver();
        $stackResolver->setPaths([__DIR__]);
        $this->assertEquals(realpath(__DIR__ . '/RelativePathResolverFactoryTest.php'), $stackResolver->resolve('RelativePathResolverFactoryTest.php'));
    }
}
