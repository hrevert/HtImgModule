<?php
namespace HtImgModuleTest\Imagine\Loader;

use HtImgModule\Imagine\Loader\LoaderPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;
use Zend\ServiceManager\ServiceManager;

class LoaderPluginManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testValidatePlugin()
    {
        $loader = $this->getMock('HtImgModule\Imagine\Loader\LoaderInterface');
        $loaders = new LoaderPluginManager(new ServiceManager());
        $this->assertEquals(null, $loaders->validatePlugin($loader));
    }

    public function testGetExceptionWithInvalidLoader()
    {
        $loaders = new LoaderPluginManager(new ServiceManager());
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');

        $loaders->validatePlugin(new \ArrayObject);
    }
}
