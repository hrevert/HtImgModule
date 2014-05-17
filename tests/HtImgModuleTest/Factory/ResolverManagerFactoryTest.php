<?php
namespace HtImgModuleTest\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\ResolverManagerFactory;
use HtImgModule\Options\ModuleOptions;

class ResolverManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions);
        $serviceManager->setService('Config', ['htimg' => ['resolvers_manager' => []]]);

        $factory = new ResolverManagerFactory();
        $this->assertInstanceOf('HtImgModule\Imagine\Resolver\ResolverManager', $factory->createService($serviceManager));
    }
}
