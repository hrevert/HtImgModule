<?php
namespace HtImgModule\Imagine\Loader;

use League\Flysystem\FilesystemInterface;
use HtImgModule\Binary\Binary;

/**
 * Image Loader for Library, flysystem
 * @see https://github.com/thephpleague/flysystem
 */
class FlysystemLoader implements LoaderInterface
{
    /**
     * @var FilesystemInterface
     */
    protected $filesystem;

    /**
     * Constructor
     *
     * @param FilesystemInterface $filesystem
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * {@inheritDoc}
     */
    public function load($path)
    {
        return $this->filesystem->read($path);
    }
}
