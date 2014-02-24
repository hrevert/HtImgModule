<?php
namespace HtImgModuleTest\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\CacheManagerFactory;
use HtImgModule\Options\ModuleOptions;

class CacheManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions);
        $factory = new CacheManagerFactory();
        $this->assertInstanceOf('HtImgModule\Service\CacheManager', $factory->createService($serviceManager));
    }
}
