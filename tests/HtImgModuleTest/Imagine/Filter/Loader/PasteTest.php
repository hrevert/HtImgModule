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
    }
}
