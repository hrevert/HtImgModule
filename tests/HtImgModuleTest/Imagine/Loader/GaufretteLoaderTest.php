<?php
namespace HtImgModuleTest\Imagine\Loader;

use Gaufrette\Exception\FileNotFound as FileNotFoundException;
use HtImgModule\Imagine\Loader\GaufretteLoader;

class GaufretteLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetExceptionWhenImageCouldNotBeFound()
    {
        $filesystem = $this->getMockBuilder('Gaufrette\Filesystem')
            ->disableOriginalConstructor()
            ->getMock();
        $filesystem->expects($this->exactly(1))
            ->method('read')
            ->with('my/special/image')
            ->will($this->throwException(new FileNotFoundException('my/special/image')));
        $loader = new GaufretteLoader($filesystem);

        $this->setExpectedException('HtImgModule\Exception\ImageNotFoundException');
        $loader->load('my/special/image');
    }

    public function testLoadOnlyContents()
    {
        $filesystem = $this->getMockBuilder('Gaufrette\Filesystem')
            ->disableOriginalConstructor()
            ->getMock();
        $filesystem->expects($this->exactly(1))
            ->method('read')
            ->will($this->returnValue('some/image/content'));
        $loader = new GaufretteLoader($filesystem);
        $this->assertEquals('some/image/content', $loader->load('asdfasdf'));
    }

    public function testLoadOnlyContentsWhenLogicException()
    {
        $filesystem = $this->getMockBuilder('Gaufrette\Filesystem')
            ->disableOriginalConstructor()
            ->getMock();
        $filesystem->expects($this->exactly(1))
            ->method('read')
            ->will($this->returnValue('some/image/content'));
        $filesystem->expects($this->exactly(1))
            ->method('mimeType')
            ->will($this->throwException(new \LogicException));
        $loader = new GaufretteLoader($filesystem);
        $this->assertEquals('some/image/content', $loader->load('asdfasdf'));
    }

    public function testGetBinary()
    {
        $filesystem = $this->getMockBuilder('Gaufrette\Filesystem')
            ->disableOriginalConstructor()
            ->getMock();
        $filesystem->expects($this->exactly(1))
            ->method('read')
            ->will($this->returnValue('some/image/content'));
        $filesystem->expects($this->exactly(1))
            ->method('mimeType')
            ->will($this->returnValue('image/jpeg'));
        $loader = new GaufretteLoader($filesystem);
        $binary = $loader->load('asdfasdf');
        $this->assertInstanceOf('HtImgModule\Binary\Binary', $binary);
        $this->assertEquals('some/image/content', $binary->getContent());
        $this->assertEquals('image/jpeg', $binary->getMimeType());
    }
}
