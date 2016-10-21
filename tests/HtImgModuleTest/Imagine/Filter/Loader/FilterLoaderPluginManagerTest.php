<?php
namespace HtImgModuleTest\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager;
use Zend\ServiceManager\ServiceManager;

class FilterLoaderPluginManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testValidatePlugin()
    {
        $filterLoaders = new FilterLoaderPluginManager(new ServiceManager());
        $this->assertEquals(null, $filterLoaders->validatePlugin($this->getMock('HtImgModule\Imagine\Filter\Loader\LoaderInterface')));
    }

    public function testGetExceptionWithInvalidPlugin()
    {
        $filterLoaders = new FilterLoaderPluginManager(new ServiceManager());
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $filterLoaders->validatePlugin(new \ArrayObject);
    }
}
