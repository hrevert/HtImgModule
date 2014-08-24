<?php
namespace HtImgModule\Imagine\Loader;

use Zend\ServiceManager\AbstractPluginManager;
use HtImgModule\Exception;

class LoaderPluginManager extends AbstractPluginManager
{
    protected $factories = [
        'filesystem' => 'HtImgModule\Factory\Imagine\Loader\FileSystemLoaderFactory',
        'simple'     => 'HtImgModule\Factory\Imagine\Loader\SimpleFileSystemLoaderFactory',
    ];

    protected $shared = [
        'simple' => false
    ];

    public function validatePlugin($plugin)
    {
        if ($plugin instanceof LoaderInterface) {
            return; // we're okay
        }

        throw new Exception\InvalidArgumentException(sprintf(
            'Plugin of type %s is invalid; must implement HtImgModule\Imagine\Loader\LoaderInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin))
        ));
    }
}
