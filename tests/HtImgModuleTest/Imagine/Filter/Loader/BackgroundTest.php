<?php

namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\Background;

class BackgroundTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $imagine = new \Imagine\Gd\Imagine;

        $loader = new Background($imagine);
        $options = [
            'width' => 100,
            'height' => 100,
            'image' => 'archos'
        ];
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Background', $loader->load($options));

    }
}
