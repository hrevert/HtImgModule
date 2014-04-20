<?php
namespace HtImgModule\Imagine\Filter;

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
       $paste = new Paste($archos, 'right', 30);
       $newImage = $paste->apply($flowers);
       //$newImage->save('resources/paste.jpg');
   }
   
   public function testGetExceptionWithInvalidCoordinate()
   {
       $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
       $imagine = new Imagine();
       $archos = $imagine->open('resources/Archos.jpg');
       $flowers = $imagine->open('resources/flowers.jpg');
       $paste = new Paste($archos, 'asdf', 'asdf');  
       $newImage = $paste->apply($flowers);     
   } 
}
