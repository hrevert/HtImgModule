<?php
namespace HtImgModuleTest\Imagine\Filter;

use Imagine\Gd\Imagine;
use HtImgModule\Imagine\Filter\Background;
use HtImgModule\Imagine\Filter\Chain;

class ChainTest extends \PHPUnit_Framework_TestCase
{
    public function testFilter()
    {
        $imagine = new Imagine();
        $filter1 = new Background($imagine, [1050, 1060], '#ddd');
        $filter2 = new Background($imagine, [1550, 1560], '#bbb');
        $chain = new Chain([$filter1, $filter2]);
        $archos = $imagine->open('resources/Archos.jpg');
        $chain->apply($archos);
    }

    public function testGetExceptionWithInvalidFilter()
    {
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $chain = new Chain(['asdf', 'asdfsdf']);
    }
}
