<?php
namespace HtImgModule\Imagine\Loader;

use HtImgModule\Imagine\Loader\GaufretteLoader;

class GaufretteLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
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
}
