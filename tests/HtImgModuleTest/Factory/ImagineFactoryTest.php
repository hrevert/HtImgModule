<?php

namespace HtImgModuleTest\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\ImagineFactory;
use HtImgModule\Options\ModuleOptions;

class ImagineFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $options = new ModuleOptions;
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\ModuleOptions', $options);
        $factory = new ImagineFactory();
        $this->assertInstanceOf('Imagine\Image\ImagineInterface', $factory->createService($serviceManager));

    }

}
