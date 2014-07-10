<?php
namespace HtImgModuleTest\Imagine\Loader;

use HtImgModule\Imagine\Loader\FlysystemLoader;
use League\Flysystem\FileNotFoundException;

class FlysystemLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetExceptionWhenImageFileCouldNotBeFound()
    {
        $filesystem = $this->getMock('League\Flysystem\FilesystemInterface');
        $filesystem->expects($this->exactly(1))
            ->method('read')
            ->with('my/special/image')
            ->will($this->throwException(new FileNotFoundException('my/special/image')));
        $loader = new FlysystemLoader($filesystem);

        $this->setExpectedException('HtImgModule\Exception\ImageNotFoundException');
        $loader->load('my/special/image');
    }

    public function testLoadBinary()
    {
        $filesystem = $this->getMock('League\Flysystem\FilesystemInterface');
        $filesystem->expects($this->exactly(1))
            ->method('read')
            ->with('my/special/image')
            ->will($this->returnValue('some/image/content'));
        $filesystem->expects($this->exactly(1))
            ->method('getMimeType')
            ->with('my/special/image')
            ->will($this->returnValue('image/png'));
        $loader = new FlysystemLoader($filesystem);
        $binary = $loader->load('my/special/image');
        $this->assertInstanceOf('HtImgModule\Binary\Binary', $binary);
        $this->assertEquals('some/image/content', $binary->getContent());
        $this->assertEquals('image/png', $binary->getMimeType());
    }

    public function testLoadOnlyContentsWhenMimeTypeCouldNotDetected()
    {
        $filesystem = $this->getMock('League\Flysystem\FilesystemInterface');
        $filesystem->expects($this->exactly(1))
            ->method('read')
            ->with('my/special/image')
            ->will($this->returnValue('some/image/content'));
        $filesystem->expects($this->exactly(1))
            ->method('getMimeType')
            ->with('my/special/image')
            ->will($this->returnValue(false));
        $loader = new FlysystemLoader($filesystem);
        $this->assertEquals('some/image/content', $loader->load('my/special/image'));
    }
}
