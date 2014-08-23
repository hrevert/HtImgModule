<?php
namespace HtImgModuleTest\View\Renderer;

use HtImgModule\View\Renderer\ImageRenderer;
use HtImgModule\View\Model\ImageModel;
use Zend\View\Model\ViewModel;

class ImageRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $image = $this->getMock('Imagine\Image\ImageInterface');
        $image->expects($this->exactly(1))
            ->method('get')
            ->with('png')
            ->will($this->returnValue('image-binary-string'));

        $model = new ImageModel($image, 'png');

        $renderer = new ImageRenderer;
        $this->assertEquals('image-binary-string', $renderer->render($model));
    }

    public function testGetExceptionWhenModelIsInvalid()
    {
        $renderer = new ImageRenderer;
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $renderer->render(new ViewModel);
    }

    public function testGetEngine()
    {
        $renderer = new ImageRenderer;
        $this->assertEquals($renderer, $renderer->getEngine());
    }

    public function testSetResolver()
    {
        $renderer = new ImageRenderer;
        $this->assertEquals($renderer, $renderer->setResolver($this->getMock('Zend\View\Resolver\ResolverInterface')));
    }
}
