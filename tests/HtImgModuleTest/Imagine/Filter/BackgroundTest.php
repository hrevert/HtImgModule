<?php
namespace HtImgModuleTest\Imagine\Filter;

use Imagine\Gd\Imagine;
use HtImgModule\Imagine\Filter\Background;

class BackgroundTest extends \PHPUnit_Framework_TestCase
{
    public function testFilter()
    {
        $imagine = new Imagine();
        $filter = new Background($imagine);
        $archos = $imagine->open('resources/Archos.jpg');
        $newImage = $filter->apply($archos);
        $newImage->save('resources/background1.jpg');
        $filter = new Background($imagine, [1050, 1060], '#ddd');
        $newImage = $filter->apply($archos);
        $newImage->save('resources/background2.jpg');
        $this->assertFileExists('resources/background1.jpg');
        $this->assertFileExists('resources/background2.jpg');
        unlink('resources/background1.jpg');
        unlink('resources/background2.jpg');
    }
}
