<?php
namespace HtImgModuleTest\Service;

use HtImgModule\Options\ModuleOptions;
use HtImgModule\Service\CacheManager;
use Imagine\Gd\Imagine;

class CacheManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $cacheManager;

    public function setUp()
    {
        $this->cacheManager = new CacheManager(new ModuleOptions);
    }

    public function testGetCacheUrl()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $options->setCachePath(RESOURCES_DIR);
        $this->assertEquals(RESOURCES_DIR . '/hello/world', $cacheManager->getCacheUrl('world', 'hello'));
    }

    public function testGetCachePath()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $options->setCachePath(RESOURCES_DIR);
        $options->setWebRoot('public_html');
        $this->assertEquals('public_html/'. RESOURCES_DIR . '/hello/world', $cacheManager->getCachePath('world', 'hello'));
    }

    public function testCreateCache()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $imagine = new Imagine; 
        $image = $imagine->open(RESOURCES_DIR . '/Archos.jpg'); 
        $options->setWebRoot(RESOURCES_DIR);
        $options->setCachePath('.');
        $cacheManager->createCache('archos-crop.jpg', 'crop', $image);   
        $cacheFile = RESOURCES_DIR . '/crop/archos-crop.jpg';
        $this->assertTrue(is_readable($cacheFile)); 
        unlink($cacheFile);
    }
}
