<?php
namespace HtImgModuleTest\View\Strategy;

use HtImgModule\View\Strategy\ImageStrategy;
use HtImgModule\View\Model\ImageModel;
use Zend\View\Model\ViewModel;
use Imagine\Gd\Imagine;
use Zend\View\ViewEvent;

class ImageStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function SetUp()
    {
        $this->model = new ImageModel;
        $this->strategy = new ImageStrategy(new Imagine);
        $this->viewEvent = new ViewEvent();
        $this->viewEvent->setModel($this->model);
    }

    public function testException()
    {
        $this->setExpectedException('HtImgModule\Exception\RuntimeException');
        $this->strategy->selectRenderer($this->viewEvent);
    }

    public function testAnotherModel()
    {
        $viewEvent = new ViewEvent();
        $viewEvent->setModel(new ViewModel);
        $this->strategy->selectRenderer($viewEvent);
    }

}
