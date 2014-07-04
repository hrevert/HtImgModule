<?php
namespace HtImgModuleTest\Binary;

use HtImgModule\Binary\Binary;

class BinaryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $binary = new Binary('foo-bar.baz', 'image/gif', 'gif');
        $this->assertEquals('foo-bar.baz', $binary->getContent());
        $this->assertEquals('image/gif', $binary->getMimeType());
        $this->assertEquals('gif', $binary->getFormat());
    }

    public function testSetFormat()
    {
        $binary = new Binary('foo-bar.baz', 'image/jpeg');
        $binary->setFormat('jpeg');
        $this->assertEquals('jpeg', $binary->getFormat());
    }
}
