<?php
namespace HtImgModuleTest\View\Model;

use HtImgModule\View\Model\ImageModel;
use Imagine\Gd\Image;

class ImageModelTest extends \PHPUnit_Framework_TestCase
{
    public function testModel()
    {
        $model = new ImageModel;
        $model->setImagePath('./');
        $model->setFormat('jpeg');
        $this->assertEquals('./', $model->getImagePath());
        $this->assertEquals('jpeg', $model->getFormat());
    }
}
