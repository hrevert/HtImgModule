<?php
namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\Thumbnail;

class ThumbnailTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $options = [
            'width' => 100,
            'height' => 100,
            'mode' => 'outbound' ,
        ];
        $this->assertInstanceOf('Imagine\Filter\Basic\Thumbnail', (new Thumbnail)->load($options));
    }
}
