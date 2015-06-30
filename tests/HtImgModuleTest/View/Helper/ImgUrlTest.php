<?php
namespace HtImgModuleTest\View\Helper;

use HtImgModule\View\Helper\ImgUrl;
use HtImgModule\Options\ModuleOptions;

class ImgUrlTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNewImageNotFromCache()
    {
        $cacheManager =  $this->getMock('HtImgModule\Service\CacheManagerInterface');
        $binary = $this->getMock('HtImgModule\Binary\BinaryInterface');
        $loaderManager = $this->getMock('HtImgModule\Imagine\Loader\LoaderManagerInterface');
        $loaderManager->expects($this->once())
            ->method('loadBinary')
            ->with('path/to/some/random/image/', 'foo_view_filter')
            ->will($this->returnValue($binary));
        $filterManager = $this->getMock('HtImgModule\Imagine\Filter\FilterManagerInterface');
        $filterManager->expects($this->once())
            ->method('getFilterOptions')
            ->with('foo_view_filter')
            ->will($this->returnValue([]));
        $cacheManager->expects($this->once())
            ->method('isCachingEnabled')
            ->with('foo_view_filter', [])
            ->will($this->returnValue(false));
        $helper = new ImgUrl(
            $cacheManager,
            $filterManager,
            $loaderManager
        );
        $urlHelper = $this->getMock('Zend\View\Helper\Url');
        $renderer = $this->getMock('Zend\View\Renderer\PhpRenderer');
        $renderer->expects($this->once())
            ->method('plugin')
            ->with('url')
            ->will($this->returnValue($urlHelper));
        $urlHelper->expects($this->once())
            ->method('__invoke')
            ->will($this->returnValue('url/to/some/random/image'));
        $helper->setView($renderer);
        $this->assertEquals('url/to/some/random/image', $helper('path/to/some/random/image/', 'foo_view_filter'));
    }

    public function testGetImageFromCache()
    {
        $cacheManager =  $this->getMock('HtImgModule\Service\CacheManagerInterface');
        $cacheManager->expects($this->once())
            ->method('cacheExists')
            ->with('path/to/some/random/image/', 'foo_view_filter', 'jpeg')
            ->will($this->returnValue(true));
        $cacheManager->expects($this->once())
            ->method('getCacheUrl')
            ->with('path/to/some/random/image/', 'foo_view_filter', 'jpeg')
            ->will($this->returnValue('flowers.jpg'));
        $loaderManager = $this->getMock('HtImgModule\Imagine\Loader\LoaderManagerInterface');
        $filterManager = $this->getMock('HtImgModule\Imagine\Filter\FilterManagerInterface');
        $filterOptions = ['format' => 'jpeg'];
        $filterManager->expects($this->once())
            ->method('getFilterOptions')
            ->with('foo_view_filter')
            ->will($this->returnValue($filterOptions));
        $cacheManager->expects($this->once())
            ->method('isCachingEnabled')
            ->with('foo_view_filter', $filterOptions)
            ->will($this->returnValue(true));
        $helper = new ImgUrl(
            $cacheManager,
            $filterManager,
            $loaderManager
        );
        $renderer = $this->getMock('Zend\View\Renderer\PhpRenderer');
        $renderer->expects($this->once())
            ->method('plugin')
            ->with('basePath')
            ->will($this->returnValue(function () {return '/app';}));
        $helper->setView($renderer);
        $this->assertEquals('/app/flowers.jpg', $helper('path/to/some/random/image/', 'foo_view_filter'));
    }

    public function testGetImageFromCacheWithFullUrl()
    {

        $options = new ModuleOptions;
        $options->setCacheUrl('http://static.example.com');

        $cacheManager =  $this->getMock('HtImgModule\Service\CacheManagerInterface',
            array( 'cacheExists', 'getCacheUrl', 'getCachePath', 'createCache', 'deleteCache', 'isCachingEnabled','useCacheUrl'),
            array($options));

        $cacheManager->expects($this->once())
            ->method('cacheExists')
            ->with('path/to/some/random/image/', 'foo_view_filter', 'jpeg')
            ->will($this->returnValue(true));
        $cacheManager->expects($this->once())
            ->method('useCacheUrl')
            ->will($this->returnValue(true));
        $cacheManager->expects($this->once())
            ->method('getCacheUrl')
            ->with('path/to/some/random/image/', 'foo_view_filter', 'jpeg', true)
            ->will($this->returnValue('http://static.example.com/foo_view_filter/path/to/some/random/image/flowers.jpg'));
        $loaderManager = $this->getMock('HtImgModule\Imagine\Loader\LoaderManagerInterface');
        $filterManager = $this->getMock('HtImgModule\Imagine\Filter\FilterManagerInterface');
        $filterOptions = ['format' => 'jpeg'];
        $filterManager->expects($this->once())
            ->method('getFilterOptions')
            ->with('foo_view_filter')
            ->will($this->returnValue($filterOptions));
        $cacheManager->expects($this->once())
            ->method('isCachingEnabled')
            ->with('foo_view_filter', $filterOptions)
            ->will($this->returnValue(true));
        $helper = new ImgUrl(
            $cacheManager,
            $filterManager,
            $loaderManager
        );
        $renderer = $this->getMock('Zend\View\Renderer\PhpRenderer');
        $helper->setView($renderer);
        $this->assertEquals('http://static.example.com/foo_view_filter/path/to/some/random/image/flowers.jpg', $helper('path/to/some/random/image/', 'foo_view_filter'));
    }
}
