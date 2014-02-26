<?php
namespace HtImgModuleTest\Service;

use HtImgModule\Service\ImageService;
use HtImgModule\Options\ModuleOptions;
use HtImgModule\Service\CacheManager;
use Imagine\Gd\Imagine;
use HtImgModule\Imagine\Filter\FilterManager;
use Zend\ServiceManager\ServiceManager;

class ImageServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetExceptionWhenResolverCannotResolve()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $imagine = new Imagine;
        $resolver = $this->getMock('Zend\View\Resolver\AggregateResolver');
        $resolver->expects($this->any())
            ->method('resolve')
            ->will($this->returnValue(false));
        $filterManager = new FilterManager($options, $this->getMock('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager'));
        $filterManager->addFilter('my_special_filter', ['type' => 'thumbnail', 'options' => []]);
        $imageService = new ImageService(
            $cacheManager,
            $options,
            $imagine,
            $resolver,
            $filterManager
        );
        $this->setExpectedException('HtImgModule\Exception\ImageNotFoundException');
        $imageService->getImageFromRelativePath('path/to/image/', 'my_special_filter');
    }

    public function testGetImageNotFromCache()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $imagine = new Imagine;
        $resolver = $this->getMock('Zend\View\Resolver\AggregateResolver');
        $resolver->expects($this->any())
            ->method('resolve')
            ->will($this->returnValue(RESOURCES_DIR . '/Archos.jpg'));
        $filter = $this->getMock('Imagine\Filter\FilterInterface');
        $filter->expects($this->any())
            ->method('apply')
            ->will($this->returnValue($this->getMock('Imagine\Image\ImageInterface')));
        $filterLoader = $this->getMock('HtImgModule\Imagine\Filter\Loader\LoaderInterface');
        $filterLoader->expects($this->any())
            ->method('load')
            ->will($this->returnValue($filter));
            
        $filterLoaderPluginManager = $this->getMock('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager');
        $filterLoaderPluginManager->expects($this->any())
            ->method('get')
            ->will($this->returnValue($filterLoader));
        $filterManager = $this->getMock(
            'HtImgModule\Imagine\Filter\FilterManager',
            null,
            [$options, $filterLoaderPluginManager]
        );
        $filterManager->addFilter('my_special_filter', ['type' => 'thumbnail', 'options' => []]);
        $imageService = new ImageService(
            $cacheManager,
            $options,
            $imagine,
            $resolver,
            $filterManager
        );
        $imageData = $imageService->getImageFromRelativePath('path/to/image/', 'my_special_filter'); 
        $this->assertInstanceOf('Imagine\Image\ImageInterface', $imageData['image']);       
        $this->assertEquals('jpg', $imageData['format']);       
    }
}
