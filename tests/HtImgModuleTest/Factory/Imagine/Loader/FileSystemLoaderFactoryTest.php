<?php
namespace HtImgModuleTest\Factory\Imagine\Loader;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\Imagine\Loader\FileSystemLoaderFactory;

class FileSystemLoaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $resolver = $this->getMock('HtImgModule\Imagine\Resolver\ResolverInterface');
        $serviceManager->setService('HtImg\RelativePathResolver', $resolver);
        $factory = new FileSystemLoaderFactory();
        $imageLoaders = $this->getMock('Zend\ServiceManager\AbstractPluginManager');
        $imageLoaders->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($serviceManager));
        $this->assertInstanceOf('HtImgModule\Imagine\Loader\FileSystemLoader', $factory->createService($imageLoaders));
    }
}
