<?php
namespace HtImgModuleTest\Imagine\Filter;

use Imagine\Gd\Imagine;
use HtImgModule\Imagine\Filter\Paste;

class PasteTest extends \PHPUnit_Framework_TestCase
{
   public function testFilter()
   {
       $imagine = new Imagine();
       $flowers = $imagine->open('resources/flowers.jpg');
       $archos = $imagine->open('resources/Archos.jpg');
       $paste = new Paste($archos, 10, 30);
       $newImage = $paste->apply($flowers);
       $paste = new Paste($archos, 'right', 'middle');
       $newImage = $paste->apply($flowers);
       //$newImage->save('resources/paste.jpg');
   }

   public function testGetExceptionWithInvalidStringXCoordinate()
   {
       $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
       $imagine = new Imagine();
       $archos = $this->getMock('Imagine\Image\ImageInterface');
       $paste = new Paste($archos, 'asdf', 'asdf');
   }

   public function testGetExceptionWithInvalidStringYCoordinate()
   {
       $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
       $imagine = new Imagine();
       $archos = $this->getMock('Imagine\Image\ImageInterface');
       $paste = new Paste($archos, 546, 'asdf');
   }

   public function testConvertStringCoordinateToNumber()
   {
       $imagine = new Imagine();
       $flowers = $imagine->open('resources/flowers.jpg');
       $archos = $imagine->open('resources/Archos.jpg');
       $paste = new Paste($archos, 'center', 'top');
       $newImage = $paste->apply($flowers);
       $paste = new Paste($archos, 'left', 'bottom');
       $newImage = $paste->apply($flowers);
   }

   public function testGetExceptionWIthNegativeCoordinate()
   {
       $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
       $image = $this->getMock('Imagine\Image\ImageInterface');
       $paste = new Paste($image, -100, 'top');
   }
}
