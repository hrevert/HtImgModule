<?php
namespace HtImgModuleTest\Imagine\Filter\Loader\Factory;

use HtImgModule\Imagine\Filter\Loader\Factory\ChainFactory;
use Zend\ServiceManager\ServiceManager;

class ChainFactoryTest extends \PHPUnit_Framework_Testcase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager;
        $serviceManager->setService('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager', $this->getMock('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager'));
        $loaders = $this->getMock('Zend\ServiceManager\AbstractPluginManager');
        $loaders->expects($this->any())
            ->method('getServiceLocator')
           ->will($this->returnValue($serviceManager));
        $factory = new ChainFactory();
        $loader = $factory->createService($loaders);
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Loader\Chain', $loader);
    }
}
