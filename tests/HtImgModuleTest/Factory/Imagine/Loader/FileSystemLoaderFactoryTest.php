<?php
namespace HtImgModuleTest\Factory\Imagine\Loader;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Factory\Imagine\Loader\FileSystemLoaderFactory;

class FileSystemLoaderFactoryTest implements FactoryInterface
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $resolver = $this->getMock('Zend\View\Resolver\ResolverInterface');
        $serviceManager->setService('HtImg\RelativePathResolver', $resolver);
        $factory = new FileSystemLoaderFactory();
        $imageLoaders = $this->getMock('Zend\Service\AbstractPluginManager');
        $imageLoaders->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($serviceManager));
        $this->assertInstanceOf('HtImgModule\Imagine\Loader\LoaderPluginManager', $factory->createService($imageLoaders));
    } 
}
