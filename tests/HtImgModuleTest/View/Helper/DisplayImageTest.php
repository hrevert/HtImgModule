<?php
namespace HtImgModuleTest\View\Helper;

use HtImgModule\View\Helper\DisplayImage;

class DisplayImageTest extends \PHPUnit_Framework_TestCase
{
    public function testSetAttributes()
    {
        $helper = new DisplayImage;
        $helper->setAttributes(['class' => 'pull-right', 'foo' => 'bar']);
        $this->assertEquals(['class' => 'pull-right', 'foo' => 'bar'], $helper->getAttributes());
    }

    public function testGetImageTag()
    {
        $helper = new DisplayImage;
        $helper->setAttributes(['alt' => 'hello']);
        $renderer = $this->getMock('Zend\View\Renderer\PhpRenderer');

        $doctype = $this->getMock('Zend\View\Helper\Doctype');
        $doctype->expects($this->once())
            ->method('isXhtml')
            ->will($this->returnValue(true));

        $map = [
            ['HtImgModule\View\Helper\ImgUrl',  function(){return '/app';}],
            ['doctype', $doctype],

        ];

        $renderer->expects($this->once())
            ->method('plugin')
            ->will($this->returnValueMap($map));
        
        $helper->setView($renderer);
        var_dump($renderer->plugin('HtImgModule\View\Helper\ImgUrl'));
        $this->assertEquals('<img src="/app"/>', $helper('asdfsadf', 'asdfasfd'));
    }
}
