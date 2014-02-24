<?php
namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\Crop;

class CropTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $loader = new Crop();
        $options = [
            'start' => [100, 200],
            'width' => 100,
            'height' => 100,
        ];
        $filter = $loader->load($options);
        $this->assertInstanceOf('Imagine\Filter\Basic\Crop', $filter);
    }
}
