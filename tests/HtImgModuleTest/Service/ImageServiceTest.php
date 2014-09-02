<?php
namespace HtImgModuleTest\Service;

use HtImgModule\Service\ImageService;
use HtImgModule\Options\ModuleOptions;
use HtImgModule\Service\CacheManager;
use Imagine\Gd\Imagine;
use HtImgModule\Imagine\Filter\FilterManager;

class ImageServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetImageFromCache()
    {
        $cacheManager =  $this->getMock('HtImgModule\Service\CacheManagerInterface');
        $cacheManager->expects($this->once())
            ->method('cacheExists')
            ->will($this->returnValue(true));
        $cacheManager->expects($this->once())
            ->method('getCachePath')
            ->will($this->returnValue(RESOURCES_DIR . '/flowers.jpg'));
        $imagine = $this->getMock('Imagine\Image\ImagineInterface');
        $filterManager = $this->getMock('HtImgModule\Imagine\Filter\FilterManagerInterface');
        $loaderManager = $this->getMock('HtImgModule\Imagine\Loader\LoaderManagerInterface');
        $imageService = new ImageService(
            $cacheManager,
            $imagine,
            $filterManager,
            $loaderManager
        );

        $filterOptions = ['format' => 'jpg'];

        $filterManager->expects($this->once())
            ->method('getFilterOptions')
            ->with('foo_filter')
            ->will($this->returnValue($filterOptions));

        $cacheManager->expects($this->once())
            ->method('isCachingEnabled')
            ->with('foo_filter', $filterOptions)
            ->will($this->returnValue(true));

        $image = $this->getMock('Imagine\Image\ImageInterface');
        $imagine->expects($this->once())
            ->method('open')
            ->with(RESOURCES_DIR . '/flowers.jpg')
            ->will($this->returnValue($image));

        $imageData = $imageService->getImage('path/to/image/flowers.jpg', 'foo_filter');

        $this->assertEquals($image, $imageData['image']);
    }

    public function testGetImageFromRelativePathAndCreateCache()
    {
        $cacheManager =  $this->getMock('HtImgModule\Service\CacheManagerInterface');
        $imagine = $this->getMock('Imagine\Image\ImagineInterface');
        $filterManager = $this->getMock('HtImgModule\Imagine\Filter\FilterManagerInterface');
        $loaderManager = $this->getMock('HtImgModule\Imagine\Loader\LoaderManagerInterface');
        $imageService = new ImageService(
            $cacheManager,
            $imagine,
            $filterManager,
            $loaderManager
        );

        $binaryContent = '35345fascxzcasdfhj;alsdkf4asldfkja;sldf65854';
        $relativePath = 'relative/path/to/image';
        $filterName = 'foo-bar-filter';
        $filterManager->expects($this->once())
            ->method('getFilterOptions')
            ->with($filterName)
            ->will($this->returnValue([]));

        $binary = $this->getMock('HtImgModule\Binary\BinaryInterface');
        $binary->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue($binaryContent));
        $loaderManager->expects($this->once())
            ->method('loadBinary')
            ->with($relativePath, $filterName)
            ->will($this->returnValue($binary));

        $image = $this->getMock('Imagine\Image\ImageInterface');

        $imagine->expects($this->once())
            ->method('load')
            ->with($binaryContent)
            ->will($this->returnValue($image));

        $filteredImage = $this->getMock('Imagine\Image\ImageInterface');
        $filter = $this->getMock('Imagine\Filter\FilterInterface');
        $filter->expects($this->once())
            ->method('apply')
            ->with($image)
            ->will($this->returnValue($filteredImage));

        $filterManager->expects($this->once())
            ->method('getFilter')
            ->with($filterName)
            ->will($this->returnValue($filter));

        $cacheManager->expects($this->any())
            ->method('isCachingEnabled')
            ->with($filterName, [])
            ->will($this->returnValue(true));

        $cacheManager->expects($this->once())
            ->method('createCache')
            ->with($relativePath, $filterName, $filteredImage, 'png');

        $imageData = $imageService->getImage($relativePath, $filterName);

        $this->assertEquals($image, $imageData['image']);
    }
}
