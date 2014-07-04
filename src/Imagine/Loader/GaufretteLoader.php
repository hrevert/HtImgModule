<?php
namespace HtImgModule\Imagine\Loader;

use Gaufrette\Filesystem;

/**
 * Image Loader for Library, Gaufrette
 * @see https://github.com/KnpLabs/Gaufrette
 */
class GaufretteLoader implements LoaderInterface
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Constructor
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
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
