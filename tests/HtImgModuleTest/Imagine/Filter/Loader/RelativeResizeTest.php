<?php

namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\RelativeResize;

class RelativeResizeTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $loader = new RelativeResize();
        $options = [
            'heighten' => 'sakdjfl;ksadjflk',
        ];
        $filter = $loader->load($options);
        $this->assertInstanceOf('Imagine\Filter\Advanced\RelativeResize', $filter);
    }

    public function testGetExcpeptionWithEmptyOrNoOptions()
    {
        $loader = new RelativeResize();
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $filter = $loader->load([]);
    }
}
