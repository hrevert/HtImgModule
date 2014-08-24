<?php
namespace HtImgModuleTest\Factory\Imagine\Loader;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\Imagine\Loader\SimpleFileSystemLoaderFactory;    

class SimpleFileSystemLoaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceManager = new ServiceManager();
        $factory = new SimpleFileSystemLoaderFactory;
        $factory->setCreationOptions(['root_path' => 'data/images']);
        $this->assertInstanceOf('HtImgModule\Imagine\Loader\SimpleFileSystemLoader', $factory->createService($serviceManager));
    }

    public function testGetExceptionWhenRootPathOptionIsMissing()
    {
        $serviceManager = new ServiceManager();
        $factory = new SimpleFileSystemLoaderFactory;
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $factory->createService($serviceManager);
    }
}
