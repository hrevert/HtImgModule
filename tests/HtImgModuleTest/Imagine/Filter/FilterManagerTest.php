<?php

namespace HtImgModuleTest\Imagine\Filter;

use HtImgModule\Options\ModuleOptions;
use HtImgModule\Imagine\Filter\FilterManager;
use Zend\ServiceManager\ServiceManager;

class FilterManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $filterManager;

    public function SetUp()
    {
        $this->filterManager = new FilterManager(
            new ModuleOptions,
            new ServiceManager
        );
    }

    public function testFilterNotFoundException()
    {
        $filterManager = new FilterManager(
            new ModuleOptions,
            new ServiceManager
        );
        $this->setExpectedException('HtImgModule\Exception\FilterNotFoundException');
        $filterManager->getFilter('not_available');
    }

    public function testExceptionWithNoFilterType()
    {
        $options = new ModuleOptions;
        $filterManager = new FilterManager(
            $options,
            new ServiceManager
        );
        $options->addFilter('hello', ['options' => 'hello']);
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $filterManager->getFilter('hello');
    }

    public function testExceptionWithNoFilterOptions()
    {
        $options = new ModuleOptions;
        $filterManager = new FilterManager(
            $options,
            new ServiceManager
        );
        $options->addFilter('hello', ['type' => 'hello']);
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $filterManager->getFilter('hello');
    }

    public function testGetFilterOptions()
    {
        $options = new ModuleOptions;
        $filterManager = new FilterManager(
            $options,
            new ServiceManager
        );
        $options->addFilter('filter_name', ['type' => 'hello', 'options' => ['key' => 'value']]);
        $filterOptions = $filterManager->getFilterOptions('filter_name');
        $this->assertEquals(['key' => 'value'], $filterOptions);
    }

    public function testGetFilter()
    {
        $options = new ModuleOptions;
        $filterLoaders = new ServiceManager;
        $loader = $this->getMock('HtImgModule\Imagine\Filter\Loader\LoaderInterface');
        $loader->expects($this->any())
            ->method('load')
            ->will($this->returnValue('sample_loader'));
        $filterLoaders->setService('hello123', $loader);
        $filterManager = new FilterManager(
            $options,
            $filterLoaders
        );
        $options->addFilter('filter_name', ['type' => 'hello123', 'options' => ['key' => 'value']]);
        $this->assertEquals('sample_loader', $filterManager->getFilter('filter_name'));
    }

    public function testAddFilter()
    {
        $options = new ModuleOptions;
        $filterLoaders = new ServiceManager;
        $filterManager = new FilterManager(
            $options,
            $filterLoaders
        );
        $filterManager->addFilter('foo_filter', ['foo3' => 'bar3']);
        $this->assertEquals( ['foo3' => 'bar3'], $options->getFilters()['foo_filter']);
    }

    /**
     * @covers HtImgModule\Imagine\Filter\FilterManager::applyFilter
     */
    public function testApplyFilter()
    {
        $options = new ModuleOptions;
        $filterLoaders = new ServiceManager;
        $loader = $this->getMock('HtImgModule\Imagine\Filter\Loader\LoaderInterface');
        $filter = $this->getMock('Imagine\Filter\FilterInterface');
        $image = $this->getMock('Imagine\Image\ImageInterface');
        $filteredImage = $this->getMock('Imagine\Image\ImageInterface');
        $loader->expects($this->any())
            ->method('load')
            ->will($this->returnValue($filter));
        $filter->expects($this->once())
            ->method('apply')
            ->will($this->returnValue($filteredImage));
        $filterLoaders->setService('bar_filter', $loader);
        $filterManager = new FilterManager(
            $options,
            $filterLoaders
        );
        $options->addFilter('bar_filter', ['type' => 'bar_filter', 'options' => ['key' => 'value']]);
        $this->assertEquals($filteredImage, $filterManager->applyFilter($image, 'bar_filter'));
    }
}
