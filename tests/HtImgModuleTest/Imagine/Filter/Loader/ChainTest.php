<?php

namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\Chain;
use Zend\ServiceManager\ServiceManager;

class ChainTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $filterLoaders = new ServiceManager;
        $filterLoader = $this->getMock('HtImgModule\Imagine\Filter\Loader\LoaderInterface');
        $filterLoader->expects($this->any())
            ->method('load')
            ->will($this->returnValue($this->getMock('Imagine\Filter\FilterInterface')));
        $filterLoaders->setService('thumbnail', $filterLoader);
        $chainLoader = new  Chain($filterLoaders);
        $chainFilter = $chainLoader->load(['filters' => ['thumbnail' => ['options' => []]]]);
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Chain', $chainFilter);
    }

    public function testGetExceptionWithNoFilter()
    {
        $filterLoaders = new ServiceManager;
        $chainLoader = new  Chain($filterLoaders);
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $chainFilter = $chainLoader->load(['filters' => []]);
    }

    public function testGetExceptionWithInvalidOptionsType()
    {
        $filterLoaders = new ServiceManager;
        $chainLoader = new  Chain($filterLoaders);
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $chainFilter = $chainLoader->load(['filters' => '']);
    }
}
