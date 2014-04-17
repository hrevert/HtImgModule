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
            'image_resolvers' => ['image_resolvers']
        ]);
        $this->assertEquals(false, $moduleOptions->getEnableCache());
        $this->assertEquals(['img/'], $moduleOptions->getImgSourcePathStack());
        $this->assertEquals('hello', $moduleOptions->getImgSourceMap()['name']);
        $this->assertEquals('imagick', $moduleOptions->getDriver());
        $this->assertEquals('hello', $moduleOptions->getFilters()[0]);
        $this->assertEquals('web', $moduleOptions->getWebRoot());
        $this->assertEquals(['image_resolvers'], $moduleOptions->getImageResolvers());
    }

}
