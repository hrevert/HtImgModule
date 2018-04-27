<?php

namespace HtImgModuleTest\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\ImageServiceFactory;
use HtImgModule\Options\ModuleOptions;

class ImageServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\Imagine', $this->createMock('Imagine\Image\ImagineInterface'));
        $serviceManager->setService('HtImgModule\Imagine\Filter\FilterManager', $this->createMock('HtImgModule\Imagine\Filter\FilterManagerInterface'));
        $serviceManager->setService('HtImgModule\Service\CacheManager', $this->createMock('HtImgModule\Service\CacheManagerInterface'));
        $serviceManager->setService('HtImgModule\Imagine\Loader\LoaderManager', $this->createMock('HtImgModule\Imagine\Loader\LoaderManagerInterface'));

        $factory = new ImageServiceFactory();
        $this->assertInstanceOf('HtImgModule\Service\ImageService', $factory->createService($serviceManager));
    }
}
