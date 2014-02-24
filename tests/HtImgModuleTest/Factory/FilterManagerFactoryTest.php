<?php
namespace HtImgModuleTest\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\FilterManagerFactory;
use HtImgModule\Options\ModuleOptions;
use HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager;

class FilterManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions);
        $serviceManager->setService('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager', new FilterLoaderPluginManager);
        $factory = new FilterManagerFactory();
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\FilterManager', $factory->createService($serviceManager));
    }
}
