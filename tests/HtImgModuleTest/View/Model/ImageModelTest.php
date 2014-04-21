<?php
namespace HtImgModuleTest\View\Model;

use HtImgModule\View\Model\ImageModel;
use Imagine\Gd\Imagine;

class ImageModelTest extends \PHPUnit_Framework_TestCase
{
    public function testSettersAndGetters()
    {
        $model = new ImageModel('./');
        $model->setFormat('jpeg');
        $this->assertEquals('./', $model->getImagePath());
        $this->assertEquals('jpeg', $model->getFormat());
        $imagine = new Imagine();
        $archos = $imagine->open('resources/Archos.jpg');
        $model = new ImageModel($archos, 'gif');
        $this->assertEquals($archos, $model->getImage());
        $this->assertEquals('gif', $model->getFormat());
    }

    public function testGetExceptionWithInvalidConstructorArgument()
    {
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $model = new ImageModel(new \ArrayObject);
    }
}
