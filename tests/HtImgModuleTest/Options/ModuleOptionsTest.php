<?php

namespace HtImgModuleTest\Options;

use HtImgModule\Options\ModuleOptions;

class ModuleOptionsTest extends \PHPUnit_Framework_TestCase
{
    protected $moduleOptions;

    public function setUp()
    {
        $this->moduleOptions = new ModuleOptions(array(
            'enable_cache' => false,
            'img_source_path_stack' => ['img/'],
            'img_source_map' => array('name' => 'hello'),
            'driver' => 'imagick',
            'filters' => ['hello'],
            'web_root' => 'web',
        ));
    }

    public function testSettersAndGetters()
    {
        $this->assertEquals(false, $this->moduleOptions->getEnableCache());
        $this->assertEquals(['img/'], $this->moduleOptions->getImgSourcePathStack());
        $this->assertEquals('hello', $this->moduleOptions->getImgSourceMap()['name']);
        $this->assertEquals('imagick', $this->moduleOptions->getDriver());
        $this->assertEquals('hello', $this->moduleOptions->getFilters()[0]);
        $this->assertEquals('web', $this->moduleOptions->getWebRoot());
    }

}
