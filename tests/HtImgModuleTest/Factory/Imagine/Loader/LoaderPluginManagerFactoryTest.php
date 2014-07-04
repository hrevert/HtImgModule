<?php
namespace HtImgModuleTest\Factory\Imagine\Loader;

use HtImgModule\Factory\Imagine\Loader\LoaderPluginManagerFactory;
use Zend\ServiceManager\ServiceManager;

class LoaderPluginManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('Config', ['htimg' => ['loaders' => []]]);
        $factory = new LoaderPluginManagerFactory();
        $this->assertInstanceOf('HtImgModule\Imagine\Loader\LoaderPluginManager', $factory->createService($serviceManager));
    }
}
