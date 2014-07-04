<?php
namespace HtImgModuleTest\View\Helper;

use HtImgModule\View\Helper\ImgUrl;
use HtImgModule\Options\ModuleOptions;
use HtImgModule\Service\CacheManager;
use HtImgModule\Imagine\Filter\FilterManager;

class ImgUrlTest extends \PHPUnit_Framework_TestCase
{
    public function testGetExceptionWhenResolverCannotResolve()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $resolver = $this->getMock('Zend\View\Resolver\AggregateResolver');
        $resolver->expects($this->any())
            ->method('resolve')
            ->will($this->returnValue(false));
        $filterManager = new FilterManager($options, $this->getMock('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager'));
        $filterManager->addFilter('foo_view_filter', ['type' => 'foo_view_filter_thumbnail', 'options' => ['format' => 'gif']]);
        $helper = new ImgUrl(
            $cacheManager,
            $options,
            $filterManager,
            $resolver
        );
        $this->setExpectedException('HtImgModule\Exception\ImageNotFoundException');
        $helper('path/to/some/random/image/', 'foo_view_filter');
    }

    public function testGetNewImageNotFromCache()
    {
        $options = new ModuleOptions;
        $cacheManager =  $this->getMockBuilder('HtImgModule\Service\CacheManager')
            ->disableOriginalConstructor()
            ->getMock();
        $cacheManager->expects($this->once())
            ->method('cacheExists')
            ->will($this->returnValue(true));
        $cacheManager->expects($this->once())
            ->method('getCacheUrl')
            ->will($this->returnValue(RESOURCES_DIR . '/flowers.jpg'));
        $resolver = $this->getMock('Zend\View\Resolver\AggregateResolver');
        $resolver->expects($this->any())
            ->method('resolve')
            ->will($this->returnValue(true));
        $filterManager = new FilterManager($options, $this->getMock('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager'));
        $filterManager->addFilter('foo_view_filter', ['type' => 'foo_view_filter_thumbnail', 'options' => []]);
        $helper = new ImgUrl(
            $cacheManager,
            $options,
            $filterManager,
            $resolver
        );
        $renderer = $this->getMock('Zend\View\Renderer\PhpRenderer');
        $renderer->expects($this->once())
            ->method('plugin')
            ->will($this->returnValue(function () {return 'app';}));
        $helper->setView($renderer);
        $helper('path/to/some/random/image/', 'foo_view_filter');
    }

    public function testGetImageFromCache()
    {
        $options = new ModuleOptions;
        $cacheManager =  $this->getMockBuilder('HtImgModule\Service\CacheManager')
            ->disableOriginalConstructor()
            ->getMock();
        $cacheManager->expects($this->once())
            ->method('cacheExists')
            ->will($this->returnValue(false));
        $resolver = $this->getMock('Zend\View\Resolver\AggregateResolver');
        $resolver->expects($this->any())
            ->method('resolve')
            ->will($this->returnValue(true));
        $filterManager = new FilterManager($options, $this->getMock('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager'));
        $filterManager->addFilter('foo_view_filter', ['type' => 'foo_view_filter_thumbnail', 'options' => []]);
        $helper = new ImgUrl(
            $cacheManager,
            $options,
            $filterManager,
            $resolver
        );
        $renderer = $this->getMock('Zend\View\Renderer\PhpRenderer');
        $renderer->expects($this->once())
            ->method('plugin')
            ->will($this->returnValue(function () {return 'app';}));
        $helper->setView($renderer);
        $helper('path/to/some/random/image/', 'foo_view_filter');
    }
}
