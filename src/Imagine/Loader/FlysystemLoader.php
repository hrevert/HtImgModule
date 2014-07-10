<?php
namespace HtImgModule\Imagine\Loader;

use HtImgModule\Binary\Binary;
use HtImgModule\Exception;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\FileNotFoundException;

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
        try {
            $contents = $this->filesystem->read($path);
        } catch (FileNotFoundException $e) {
            throw new Exception\ImageNotFoundException(sprintf('Source image not found in "%s"', $path));
        }

        $mimeType = $this->filesystem->getMimeType($path);
        if ($mimeType === false) {
            // Mime Type could not be detected
            return $contents;
        }

        return new Binary($contents, $mimeType);
    }
}
