<?php

namespace HtImgModuleTest\Options;

use HtImgModule\Options\ModuleOptions;

class ModuleOptionsTest extends \PHPUnit_Framework_TestCase
{

    public function testSettersAndGetters()
    {
        $moduleOptions = new ModuleOptions([
            'enable_cache' => false,
            'img_source_path_stack' => ['img/'],
            'img_source_map' => ['name' => 'hello'],
            'driver' => 'imagick',
            'filters' => ['hello'],
            'web_root' => 'web',
            'image_resolvers' => ['image_resolvers'],
            'cache_path' => 'images',
            'cache_expiry' => 678678,
            'filter_loaders' => ['factories' => [], 'aliases' => []],
            'default_image_loader' => 'my_image_loader',
        ]);
        $this->assertEquals(false, $moduleOptions->getEnableCache());
        $this->assertEquals(['img/'], $moduleOptions->getImgSourcePathStack());
        $this->assertEquals(['name' => 'hello'], $moduleOptions->getImgSourceMap());
        $this->assertEquals('imagick', $moduleOptions->getDriver());
        $this->assertEquals(['hello'], $moduleOptions->getFilters());
        $this->assertEquals('web', $moduleOptions->getWebRoot());
        $this->assertEquals(['image_resolvers'], $moduleOptions->getImageResolvers());
        $this->assertEquals('images', $moduleOptions->getCachePath());
        $this->assertEquals(678678, $moduleOptions->getCacheExpiry());
        $this->assertEquals(['factories' => [], 'aliases' => []], $moduleOptions->getFilterLoaders());
        $this->assertEquals('my_image_loader', $moduleOptions->getDefaultImageLoader());
    }

    public function testGetExceptionWithInvalidDriver()
    {
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        $moduleOptions = new ModuleOptions(['driver' => 'iasfdasdf',]);
    }

    public function testAddFilter()
    {
        $moduleOptions = new ModuleOptions;
        $moduleOptions->addFilter('foo_and_crop', ['foo' => 'crop']);
        $this->assertCount(1, $moduleOptions->getFilters());
        $this->assertEquals(['foo' => 'crop'], $moduleOptions->getFilters()['foo_and_crop']);
    }
}
