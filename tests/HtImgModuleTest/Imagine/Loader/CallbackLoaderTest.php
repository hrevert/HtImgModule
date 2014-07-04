<?php
namespace HtImgModuleTest\Imagine\Loader;

use HtImgModule\Imagine\Loader\CallbackLoader;

class CallbackLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $loader = new CallbackLoader(
            function ($path) {
                $this->assertEquals('some/image.jpeg', $path);

                return 'path/to/some-image.jpeg';
            }
        );

        $this->assertEquals('path/to/some-image.jpeg', $loader->load('some/image.jpeg'));
    }
}
