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
        $serviceManager->setService('HtImg\Imagine', $this->getMock('Imagine\Image\ImagineInterface'));
        $serviceManager->setService('HtImgModule\Imagine\Filter\FilterManager', $this->getMock('HtImgModule\Imagine\Filter\FilterManagerInterface'));
        $serviceManager->setService('HtImgModule\Service\CacheManager', $this->getMock('HtImgModule\Service\CacheManagerInterface'));
        $serviceManager->setService('HtImgModule\Imagine\Loader\LoaderManager', $this->getMock('HtImgModule\Imagine\Loader\LoaderManagerInterface'));

        $factory = new ImageServiceFactory();
        $this->assertInstanceOf('HtImgModule\Service\ImageService', $factory->createService($serviceManager));
    }
}
