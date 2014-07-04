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
        $options = new ModuleOptions;
        $imagine = $this->getMock('Imagine\Image\ImagineInterface');
        $filterManager = new FilterManager($options, $this->getMock('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager'));
        $loaderManager = $this->getMock('HtImgModule\Imagine\Loader\LoaderManagerInterface');
        $imageService = new ImageService(
            $options,
            $imagine,
            $filterManager,
            $loaderManager
        );
        $cacheManager =  $this->getMock('HtImgModule\Service\CacheManagerInterface');
        $cacheManager->expects($this->once())
            ->method('cacheExists')
            ->will($this->returnValue(true));
        $cacheManager->expects($this->once())
            ->method('getCachePath')
            ->will($this->returnValue(RESOURCES_DIR . '/flowers.jpg'));
        $imageService->setCacheManager($cacheManager);

        $filterManager->addFilter('foo_filter', ['type' => 'foo_thumbnail', 'options' => ['format' => 'jpg']]);

        $image = $this->getMock('Imagine\Image\ImageInterface');
        $imagine->expects($this->once())
            ->method('open')
            ->with(RESOURCES_DIR . '/flowers.jpg')
            ->will($this->returnValue($image));

        $imageData = $imageService->getImage('path/to/image/flowers.jpg', 'foo_filter');

        $this->assertEquals($image, $imageData['image']);
    }
}
