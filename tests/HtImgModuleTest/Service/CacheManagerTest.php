<?php
namespace HtImgModuleTest\Service;

use HtImgModule\Options\ModuleOptions;
use HtImgModule\Service\CacheManager;
use Imagine\Gd\Imagine;

class CacheManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers HtImgModule\Service\CacheManager::getCacheUrl
     */
    public function testGetCacheUrl()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $options->setCachePath(RESOURCES_DIR);
        $this->assertEquals(RESOURCES_DIR . '/hello/world', $cacheManager->getCacheUrl('world', 'hello'));
        $this->assertEquals(RESOURCES_DIR . '/hello/world.jpg', $cacheManager->getCacheUrl('world', 'hello', RESOURCES_DIR . '/Archos.jpg'));
    }

    /**
     * @covers HtImgModule\Service\CacheManager::getCachePath
     */
    public function testGetCachePath()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $options->setCachePath(RESOURCES_DIR);
        $options->setWebRoot('public_html');
        $this->assertEquals('public_html/'. RESOURCES_DIR . '/hello/world', $cacheManager->getCachePath('world', 'hello'));
        $this->assertEquals(RESOURCES_DIR . '/hello/Archos.jpg', $cacheManager->getCacheUrl('Archos.png', 'hello', RESOURCES_DIR . '/Archos.jpg'));
    }

    /**
     * @covers HtImgModule\Service\CacheManager::createCache
     */
    public function testCreateCache()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $imagine = new Imagine;
        $image = $imagine->open(RESOURCES_DIR . '/Archos.jpg');
        $options->setWebRoot(RESOURCES_DIR);
        $options->setCachePath('.');
        $cacheManager->createCache('awesome/archos-crop.jpg', 'crop', $image);
        $cacheFile = RESOURCES_DIR . '/crop/awesome/archos-crop.jpg';
        $this->assertTrue(is_readable($cacheFile));

        return $cacheManager;
    }

    /**
     * @covers HtImgModule\Service\CacheManager::deleteCache
     * @depends testCreateCache
     */
    public function testDeleteCache(CacheManager $cacheManager)
    {
        $cacheManager->deleteCache('awesome/archos-crop.jpg', 'crop');
        $this->assertFalse(is_readable(RESOURCES_DIR . '/crop/awesome/archos-crop.jpg'));
    }

    /**
     * @covers HtImgModule\Service\CacheManager::cacheExists
     */
    public function testCacheExists()
    {
        $options = new ModuleOptions;
        $cacheManager = new CacheManager($options);
        $imagine = new Imagine;
        $image = $imagine->open(RESOURCES_DIR . '/Archos.jpg');
        $options->setWebRoot(RESOURCES_DIR);
        $options->setCachePath('.');
        $cacheManager->createCache('awesome/archos-crop.jpg', 'crop', $image);
        $cacheFile = RESOURCES_DIR . '/crop/awesome/archos-crop.jpg';
        $this->assertTrue($cacheManager->cacheExists('awesome/archos-crop.jpg', 'crop'));
        $this->assertFalse($cacheManager->cacheExists('awesome/random-crop.jpg', 'crop'));
    }
}
