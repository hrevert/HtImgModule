<?php
namespace HtImgModuleTest\Imagine\Resolver;

use HtImgModule\Imagine\Resolver\ResolverManager;
use Zend\ServiceManager\ServiceManager;

class ResolverManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetExceptionWithInvalidResolver()
    {
        $resolverManager = new ResolverManager;
        $resolverManager->setInvokableClass('abcd', 'ArrayObject');
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $resolverManager->get('abcd');
    }
}
