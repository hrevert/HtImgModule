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
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions);
        $serviceManager->setService('HtImg\Imagine', $this->getMock('Imagine\Image\ImagineInterface'));
        $serviceManager->setService('HtImg\RelativePathResolver', $this->getMock('Zend\View\Resolver\ResolverInterface'));
        $serviceManager->setService('HtImgModule\Imagine\Filter\FilterManager', $this->getMock('HtImgModule\Imagine\Filter\FilterManagerInterface'));
        $serviceManager->setService('HtImgModule\Service\CacheManager', $this->getMock('HtImgModule\Service\CacheManagerInterface'));

        $factory = new ImageServiceFactory();
        $this->assertInstanceOf('HtImgModule\Service\ImageService', $factory->createService($serviceManager));
    }    
}
