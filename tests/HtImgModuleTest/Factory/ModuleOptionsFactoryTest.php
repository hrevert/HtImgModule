<?php

namespace HtImgModuleTest\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\ModuleOptionsFactory;

class ModuleOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $config = ['htimg' => []];

        $serviceManager = new ServiceManager();
        $serviceManager->setService('Config', $config);

        $factory = new ModuleOptionsFactory();
        $options = $factory->createService($serviceManager);

        $this->assertInstanceOf('HtImgModule\Options\ModuleOptions', $options);
    }
}
