<?php
namespace HtImgModuleTest\Factory\Imagine\Loader;

use HtImgModule\Factory\Imagine\Loader\LoaderManagerFactory;
use Zend\ServiceManager\ServiceManager;

class LoaderManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager     = new ServiceManager();
        $filterManager      = $this->getMock('HtImgModule\Imagine\Filter\FilterManagerInterface');
        $imageLoaders       = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $options            = $this->getMock('HtImgModule\Options\ModuleOptions');
        $mimeTypeGuesser    = $this->getMockBuilder('HtImgModule\Binary\MimeTypeGuesser')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager->setService('HtImgModule\Imagine\Filter\FilterManager', $filterManager);
        $serviceManager->setService('HtImgModule\Imagine\Loader\LoaderPluginManager', $imageLoaders);
        $serviceManager->setService('HtImgModule\Binary\MimeTypeGuesser', $mimeTypeGuesser);
        $serviceManager->setService('HtImg\ModuleOptions', $options);

        $factory = new LoaderManagerFactory;
        $this->assertInstanceOf('HtImgModule\Imagine\Loader\LoaderManager', $factory->createService($serviceManager));
    }
}
