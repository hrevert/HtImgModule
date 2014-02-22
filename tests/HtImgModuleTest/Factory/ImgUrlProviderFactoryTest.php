<?php

namespace HtImgModuleTest\Factory;

use HtImgModule\Factory\ImgUrlProviderFactory;
use Zend\ServiceManager\ServiceManager;
use HtImgModule\Options\ModuleOptions;

class ImgUrlProviderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions);
        $factory = new ImgUrlProviderFactory();

        $this->assertInstanceOf('HtImgModule\Service\ImgUrlProvider', $factory->createService($serviceManager));
    }
}
