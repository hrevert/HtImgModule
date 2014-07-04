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

    public function testLoadBinary()
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
        $imageLoaderName = 'some_image_loader';
        $binaryContent = 'asdf55asd4f53as4df54asdf564asdf';
        $mimeType = 'image/png';

        $filterManager->expects($this->once())
            ->method('getFilterOptions')
            ->with($filter)
            ->will($this->returnValue(['image_loader' => $imageLoaderName]));

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
