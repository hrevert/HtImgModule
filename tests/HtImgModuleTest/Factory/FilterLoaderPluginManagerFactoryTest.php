<?php
namespace HtImgModuleTest\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\FilterLoaderPluginManagerFactory;
use HtImgModule\Options\ModuleOptions;

class FilterLoaderPluginManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions); 
        $factory = new FilterLoaderPluginManagerFactory();
        $this->assertInstanceOf('HtImgModule\Service\FilterLoaderPluginManager', $factory->createService($serviceManager));         
    }
}
