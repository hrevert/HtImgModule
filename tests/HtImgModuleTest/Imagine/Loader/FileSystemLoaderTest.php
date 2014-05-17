<?php
namespace HtImgModuleTest\Imagine\Loader;

use HtImgModule\Imagine\Loader\FileSystemLoader;
use ReflectionClass;

class FileSystemLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $resolver = $this->getMock('Zend\View\Resolver\ResolverInterface');
        $resolver->expects($this->exactly(1))
            ->method('resolve')
            ->will($this->returnValue('a/d/g.png'));
        $loader = new FileSystemLoader($resolver);

        $reflection = new ReflectionClass($loader);
        $property = $reflection->getProperty('fiysystem');
        $property->setAccessible(true);
        $flySystem = $this->getMock('League\Flysystem\FilesystemInterface');
        $flySystem->expects($this->exactly(1))
            ->method('read')
            ->will($this->returnValue('this-is-image'));
        $property->setValue($loader, $flySystem);

        $this->assertEquals('this-is-image', $loader->load('asdf'));
    }
}
