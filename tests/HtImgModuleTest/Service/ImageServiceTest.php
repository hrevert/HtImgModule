<?php
namespace HtImgModuleTest\Service;

use HtImgModule\Service\ImageService;
use HtImgModule\Options\ModuleOptions;
use HtImgModule\Service\CacheManager; 
use Imagine\Gd\Imagine;
use HtImgModule\Imagine\Filter\FilterManager;

class ImageServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $imageService;

    public function setUp()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $imagine = new Imagine;
        $resolver = $this->getMock('Zend\View\Resolver\AggregateResolver');
        $resolver->expects($this->any())
            ->method('resolve')
            ->will($this->returnValue(true));
        $filterManager = new FilterManager($options, $this->getMock('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager'));
        $resolver->expects($this->any())
            ->method('getFilter')
            ->will($this->returnValue($this->getMock('Imagine\Filter\FilterInterface')));
        $this->imageService = new ImageService(
            $cacheManager,
            $options,
            $imagine,
            $resolver,
            $filterManager
        );
    }

    public function testGetImage()
    {

    }
}
