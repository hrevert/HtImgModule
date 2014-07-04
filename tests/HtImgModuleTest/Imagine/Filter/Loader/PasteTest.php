<?php

namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\Paste;

class PasteTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $imagine = new \Imagine\Gd\Imagine;
        $resolver = $this->getMock('Zend\View\Resolver\ResolverInterface');
        $resolver->expects($this->any())
            ->method('resolve')
            ->will($this->returnValue(RESOURCES_DIR . '/Archos.jpg'));
        $loader = new Paste($imagine, $resolver);
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Paste', $loader->load(['image' => 'image-to-pasted.jpeg']));
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Paste', $loader->load(['image' => 'image-to-pasted.jpeg', 'x' => 16, 'y' => 89]));
    }

    public function testGetExceptionWithoutImageOptions()
    {
        $resolver = $this->getMock('Zend\View\Resolver\ResolverInterface');
        $loader = new Paste($this->getMock('Imagine\Image\ImagineInterface'), $resolver);
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $loader->load([]);
    }

    public function testGetExceptionWhenImageCannotBeResolved()
    {
        $resolver = $this->getMock('Zend\View\Resolver\ResolverInterface');
        $loader = new Paste($this->getMock('Imagine\Image\ImagineInterface'), $resolver);
        $this->setExpectedException('HtImgModule\Exception\RuntimeException');
        $loader->load(['image' => 'asdf.png']);
    }
}
