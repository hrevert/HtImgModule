<?php
namespace HtImgModule\Imagine\Loader;

use HtImgModule\Factory\Imagine\Loader\FileSystemLoaderFactory;
use HtImgModule\Factory\Imagine\Loader\SimpleFileSystemLoaderFactory;
use Zend\ServiceManager\AbstractPluginManager;
use HtImgModule\Exception;
use Zend\ServiceManager\Exception\InvalidServiceException;

class LoaderPluginManager extends AbstractPluginManager
{
    protected $instanceOf = LoaderInterface::class;

    protected $factories = [
        'filesystem' => FileSystemLoaderFactory::class,
        'simple'     => SimpleFileSystemLoaderFactory::class,
    ];

    protected $shared = [
        'simple' => false
    ];

    public function validate($instance)
    {
        if (! $instance instanceof $this->instanceOf) {
            throw new InvalidServiceException(sprintf(
                'Invalid plugin "%s" created; not an instance of %s',
                get_class($instance),
                $this->instanceOf
            ));
        }
    }

    public function validatePlugin($instance)
    {
        try {
            $this->validate($instance);
        } catch (InvalidServiceException $e) {
            throw new Exception\InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
