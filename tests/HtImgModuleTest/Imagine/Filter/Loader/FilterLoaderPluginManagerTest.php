<?php
namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager;

class FilterLoaderPluginManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testValidatePlugin()
    {
        $filterLoaders = new FilterLoaderPluginManager;
        $this->assertEquals(null, $filterLoaders->validatePlugin($this->getMock('HtImgModule\Imagine\Filter\Loader\LoaderInterface')));
    }

    public function testGetExceptionWithInvalidPlugin()
    {
        $filterLoaders = new FilterLoaderPluginManager;
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $filterLoaders->validatePlugin(new \ArrayObject);
    }
}
