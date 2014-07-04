<?php
namespace HtImgModuleTest\Imagine\Filter;

use Imagine\Gd\Imagine;
use HtImgModule\Imagine\Filter\Watermark;

class WatermarkTest extends \PHPUnit_Framework_TestCase
{
    public function testFilter()
    {
       $imagine = new Imagine();
       $flowers = $imagine->open('resources/flowers.jpg');
       $archos = $imagine->open('resources/Archos.jpg');
       $watermark = new Watermark($archos, '50%');
       $newImage = $watermark->apply($flowers);
       $watermark = new Watermark($archos, '50%', 'right');
       $newImage = $watermark->apply($flowers);
       //$newImage->save('resources/watermark.jpg');
    }

   public function testGetExceptionWithInvalidPosition()
   {
       $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
       $imagine = new Imagine();
       $archos = $imagine->open('resources/Archos.jpg');
       $flowers = $imagine->open('resources/flowers.jpg');
       $watermark = new Watermark($archos, null, 'asdf');
       $newImage = $watermark->apply($flowers);
   }

   public function testGetExceptionWithInvalidWatermarkSize()
   {
       $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
       $imagine = new Imagine();
       $archos = $imagine->open('resources/Archos.jpg');
       $watermark = new Watermark($archos, 'asfd', 'asdf');
   }
}
