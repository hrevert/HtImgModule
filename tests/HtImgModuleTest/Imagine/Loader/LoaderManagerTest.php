<?php
namespace HtImgModuleTest\Imagine\Loader;

use HtImgModule\Imagine\Loader\LoaderManager;

class LoaderManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetExceptionWhenImageLoaderCannotLoadImage()
    {
        $imageLoaders  = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $filterManager = $this->getMock('HtImgModule\Imagine\Filter\FilterManagerInterface');
        $imageLoader = $this->getMock('HtImgModule\Imagine\Loader\LoaderInterface');
        $mimeTypeGuesser = $this->getMockBuilder('HtImgModule\Binary\MimeTypeGuesser')
            ->disableOriginalConstructor()
            ->getMock();
        $loadManager = new LoaderManager($imageLoaders, $filterManager, $imageLoader, $mimeTypeGuesser);

        $relativePath = 'relative/path/of/some/image';
        $imageLoader->expects($this->once())
            ->method('load')
            ->with($relativePath)
            ->will($this->returnValue(FALSE));

        $this->setExpectedException('HtImgModule\Exception\ImageNotFoundException');
        $loadManager->loadBinary($relativePath, 'asdf');
    }

    public function getData()
    {
        return [
            ['awesome_image_loader', ['loader_options' => ['a' => []]]],
            ['awesome_image_loader_2', []],
        ];
    }

    /**
     * @dataProvider getData
     */
    public function testLoadBinary($imageLoaderName, $filterOptions)
    {
        $imageLoaders  = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $filterManager = $this->getMock('HtImgModule\Imagine\Filter\FilterManagerInterface');
        $imageLoader = $this->getMock('HtImgModule\Imagine\Loader\LoaderInterface');
        $mimeTypeGuesser = $this->getMockBuilder('HtImgModule\Binary\MimeTypeGuesser')
            ->disableOriginalConstructor()
            ->getMock();
        $loadManager = new LoaderManager($imageLoaders, $filterManager, $imageLoader, $mimeTypeGuesser);

        $relativePath = 'relative/path/of/some/image';
        $filter = 'bar_filter';
        $binaryContent = 'asdf55asd4f53as4df54asdf564asdf';
        $mimeType = 'image/png';
        $filterOptions['image_loader'] = $imageLoaderName;

        $filterManager->expects($this->once())
            ->method('getFilterOptions')
            ->with($filter)
            ->will($this->returnValue($filterOptions));

        $imageLoaders->expects($this->once())
            ->method('get')
            ->with($imageLoaderName)
            ->will($this->returnValue($imageLoader));

        $imageLoader->expects($this->once())
            ->method('load')
            ->with($relativePath)
            ->will($this->returnValue($binaryContent));

        $mimeTypeGuesser->expects($this->once())
            ->method('guess')
            ->with($binaryContent)
            ->will($this->returnValue($mimeType));

        $binary = $loadManager->loadBinary($relativePath, $filter);

        $this->assertInstanceOf('HtImgModule\Binary\Binary', $binary);
        $this->assertEquals($mimeType, $binary->getMimeType());
        $this->assertEquals($loadManager->getExtensionGuesser()->guess($mimeType), $binary->getFormat());
    }
}
