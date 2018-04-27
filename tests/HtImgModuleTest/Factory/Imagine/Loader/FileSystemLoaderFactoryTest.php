<?php
namespace HtImgModuleTest\Factory\Imagine\Loader;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\Imagine\Loader\FileSystemLoaderFactory;

class FileSystemLoaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $resolver = $this->createMock('HtImgModule\Imagine\Resolver\ResolverInterface');
        $serviceManager->setService('HtImg\RelativePathResolver', $resolver);
        $factory = new FileSystemLoaderFactory();
        $imageLoaders = $this->getMockBuilder('Zend\ServiceManager\AbstractPluginManager')
            ->disableOriginalConstructor()
            ->getMock();
        if (!method_exists($serviceManager, 'configure')) {
            $imageLoaders->expects($this->once())
                ->method('getServiceLocator')
                ->will($this->returnValue($serviceManager));
        } else {
            $imageLoaders = $serviceManager;
        }

        $this->assertInstanceOf('HtImgModule\Imagine\Loader\FileSystemLoader', $factory->createService($imageLoaders));
    }
}
