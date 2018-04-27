<?php
namespace HtImgModuleTest\Imagine\Filter\Loader\Factory;

use HtImgModule\Imagine\Filter\Loader\Factory\PasteFactory;
use Zend\ServiceManager\ServiceManager;
use Imagine\Gd\Imagine;

class PasteFactoryTest extends \PHPUnit_Framework_Testcase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager;
        $serviceManager->setService('HtImg\Imagine', new Imagine);
        $serviceManager->setService('HtImg\RelativePathResolver', $this->createMock('Zend\View\Resolver\ResolverInterface'));
        $loaders = $this->getMockBuilder('Zend\ServiceManager\AbstractPluginManager')
            ->disableOriginalConstructor()
            ->getMock();
        if (!method_exists($serviceManager, 'configure')) {
            $loaders->expects($this->any())
                ->method('getServiceLocator')
               ->will($this->returnValue($serviceManager));
        } else {
            $loaders = $serviceManager;
        }
        $factory = new PasteFactory();
        $loader = $factory->createService($loaders);
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Loader\Paste', $loader);
    }
}
