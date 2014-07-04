<?php
namespace HtImgModule\Imagine\Loader;

use HtImgModule\Imagine\Loader\FlysystemLoader;

class FlysystemLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $filesystem = $this->getMock('League\Flysystem\FilesystemInterface');
        $filesystem->expects($this->exactly(1))
            ->method('read')
            ->will($this->returnValue('some/image/content'));
        $loader = new FlysystemLoader($filesystem);
        $this->assertEquals('some/image/content', $loader->load('asdfasdf'));
    }
}
