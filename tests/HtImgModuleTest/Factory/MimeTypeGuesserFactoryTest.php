<?php
namespace HtImgModuleTest\Factory;

use Zend\ServiceManager\ServiceManager;
use HtImgModule\Factory\MimeTypeGuesserFactory;

class MimeTypeGuesserFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager;
        $factory = new MimeTypeGuesserFactory();
        $this->assertInstanceOf('HtImgModule\Binary\MimeTypeGuesser', $factory->createService($serviceManager));
    }
}
