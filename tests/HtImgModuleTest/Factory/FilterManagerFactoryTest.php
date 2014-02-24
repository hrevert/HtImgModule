<?php
namespace HtImgModuleTest\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\FilterManagerFactory;
use HtImgModule\Options\ModuleOptions;
use HtImgModule\Service\FilterLoaderPluginManager;

class FilterManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions); 
        $serviceManager->setService('HtImgModule\Service\FilterLoaderPluginManager', new FilterLoaderPluginManager); 
        $factory = new FilterManagerFactory();
        $this->assertInstanceOf('HtImgModule\Service\FilterManager', $factory->createService($serviceManager));   
    }
}
