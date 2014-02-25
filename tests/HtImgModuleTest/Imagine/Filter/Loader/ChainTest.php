<?php

namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\Chain;
use Zend\Options\ModuleOptions;

class ChainTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $filterManager = $this->getMock('HtImgModule\Imagine\Filter\FilterManager');
        $filterLoader = $this->getMock('HtImgModule\Imagine\Filter\Loader\LoaderInterface');
        $filterLoader->expects($this->any())
            ->method('load')
            ->will($this->returnValue($this->getMock('HtImgModule\Imagine\Filter\FilterInterface')));
        $filterManager->expects($this->any())
            ->method('getLoader')
            ->will($this->returnValue($filterLoader));
        $chainLoader = new  Chain($filterManager);
        $chainFilter = $chainLoader->load(['filters' => []]);
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Chain', $chainFilter);
    }
}
