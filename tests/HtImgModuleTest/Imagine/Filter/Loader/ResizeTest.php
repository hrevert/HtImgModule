<?php
namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\Resize;

class ResizeTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $loader = new Resize();
        $options = [
            'width' => 100,
            'height' => 100,
        ];
        $this->assertInstanceOf('Imagine\Filter\Basic\Resize', $loader->load($options));
    }
}
