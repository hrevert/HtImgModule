<?php
namespace HtImgModuleTest\Imagine\Filter\Loader\Factory;

use HtImgModule\Imagine\Filter\Loader\Factory\BackgroundFactory;
use Zend\ServiceManager\ServiceManager;
use Imagine\Gd\Imagine;

class BackgroundFactoryTest extends \PHPUnit_Framework_Testcase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager;
        $serviceManager->setService('HtImg\Imagine', new Imagine);
        $loaders = $this->getMock('Zend\ServiceManager\AbstractPluginManager');
        $loaders->expects($this->any())
            ->method('getServiceLocator')
           ->will($this->returnValue($serviceManager));
        $factory = new BackgroundFactory();
        $loader = $factory->createService($loaders);
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Loader\Background', $loader);
    }
}
