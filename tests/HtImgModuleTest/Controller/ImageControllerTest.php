<?php
namespace HtImgModuleTest\Controller;

use HtImgModule\Controller\ImageController;
use HtImgModule\Exception;
use Zend\Mvc\MvcEvent;
use Phine\Test\Property;
use Zend\Mvc\Controller\PluginManager;

class ImageControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGet404WhenImageIsNotFound()
    {
        $imageService = $this->getMock('HtImgModule\Service\ImageServiceInterface');

        $controller = new ImageController($imageService);

        $relativePath = 'relative/path/of/image';
        $filter = 'awesome_filter';

        $pluginManager = new PluginManager;
        $controller->setPluginManager($pluginManager);
        $paramsPlugin = $this->getMock('Zend\Mvc\Controller\Plugin\Params');
        $pluginManager->setService('params', $paramsPlugin);

        $paramsPlugin->expects($this->exactly(1))
            ->method('fromQuery')
            ->with('relativePath', null)
            ->will($this->returnValue($relativePath));

        $paramsPlugin->expects($this->exactly(1))
            ->method('fromRoute')
            ->with('filter', null)
            ->will($this->returnValue($filter));

        $imageService->expects($this->once())
            ->method('getImage')
            ->with($relativePath, $filter)
            ->will($this->throwException(new Exception\ImageNotFoundException));
        $this->expect404($controller);
        $controller->displayAction();
    }

    public function testGet404WhenFilterIsNotFound()
    {
        $imageService = $this->getMock('HtImgModule\Service\ImageServiceInterface');

        $controller = new ImageController($imageService);

        $relativePath = 'relative/path/of/image';
        $filter = 'awesome_filter';

        $pluginManager = new PluginManager;
        $controller->setPluginManager($pluginManager);
        $paramsPlugin = $this->getMock('Zend\Mvc\Controller\Plugin\Params');
        $pluginManager->setService('params', $paramsPlugin);

        $paramsPlugin->expects($this->exactly(1))
            ->method('fromQuery')
            ->with('relativePath', null)
            ->will($this->returnValue($relativePath));

        $paramsPlugin->expects($this->exactly(1))
            ->method('fromRoute')
            ->with('filter', null)
            ->will($this->returnValue($filter));

        $imageService->expects($this->once())
            ->method('getImage')
            ->with($relativePath, $filter)
            ->will($this->throwException(new Exception\FilterNotFoundException));
        $this->expect404($controller);
        $controller->displayAction();
    }

    public function testDisplayImage()
    {
        $imageService = $this->getMock('HtImgModule\Service\ImageServiceInterface');

        $controller = new ImageController($imageService);

        $relativePath = 'relative/path/of/image';
        $filter = 'awesome_filter';

        $pluginManager = new PluginManager;
        $controller->setPluginManager($pluginManager);
        $paramsPlugin = $this->getMock('Zend\Mvc\Controller\Plugin\Params');
        $pluginManager->setService('params', $paramsPlugin);

        $paramsPlugin->expects($this->exactly(1))
            ->method('fromQuery')
            ->with('relativePath', null)
            ->will($this->returnValue($relativePath));

        $paramsPlugin->expects($this->exactly(1))
            ->method('fromRoute')
            ->with('filter', null)
            ->will($this->returnValue($filter));

        $image = $this->getMock('Imagine\Image\ImageInterface');
        $format = 'gif';
        $imageData = ['image' => $image, 'format' => $format];

        $imageService->expects($this->once())
            ->method('getImage')
            ->with($relativePath, $filter)
            ->will($this->returnValue($imageData));

        $imageModel = $controller->displayAction();
        $this->assertInstanceOf('HtImgModule\View\Model\ImageModel', $imageModel);
        $this->assertEquals($image, $imageModel->getImage());
        $this->assertEquals($format, $imageModel->getFormat());
    }

    protected function expect404(ImageController $controller)
    {
        $event = new MvcEvent;
        $controller->setEvent($event);
        $routeMatch = $this->getMockBuilder('Zend\Mvc\Router\RouteMatch')
            ->disableOriginalConstructor()
            ->getMock();
        $event->setRouteMatch($routeMatch);
        $response = $this->getMock('Zend\Http\Response');
        $response->expects($this->once())
            ->method('setStatusCode')
            ->with(404);
        Property::set($controller, 'response', $response);
    }
}
