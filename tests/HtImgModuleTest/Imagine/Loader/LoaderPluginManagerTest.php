<?php
namespace HtImgModuleTest\Imagine\Loader;

use HtImgModule\Imagine\Loader\LoaderPluginManager;

class LoaderPluginManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testValidatePlugin()
    {
        $loader = $this->getMock('HtImgModule\Imagine\Loader\LoaderInterface');
        $loaders = new LoaderPluginManager;
        $this->assertEquals(null, $loaders->validatePlugin($loader));
    }

    public function testGetExceptionWithInvalidLoader()
    {
        $loaders = new LoaderPluginManager;
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $loaders->validatePlugin(new \ArrayObject);
    }
}
