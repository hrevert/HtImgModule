<?php
namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\Watermark;

class WatermarkTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $imagine = new \Imagine\Gd\Imagine;
        $resolver = $this->getMock('Zend\View\Resolver\ResolverInterface');
        $resolver->expects($this->any())
            ->method('resolve')
            ->will($this->returnValue(RESOURCES_DIR . '/Archos.jpg'));
        $loader = new Watermark($imagine, $resolver);
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Watermark', $loader->load(['watermark' => 'hello.jpeg', 'size' => '10%']));
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Watermark', $loader->load(['watermark' => 'hello.jpeg']));
    }
}
