<?php
namespace HtImgModule\Imagine\Loader;

use Gaufrette\Filesystem;
use Gaufrette\Exception\FileNotFound as FileNotFoundException;
use HtImgModule\Exception;
use HtImgModule\Binary\Binary;

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
        try {
            $contents = $this->filesystem->read($path);
        } catch (FileNotFoundException $e) {
            throw new Exception\ImageNotFoundException(sprintf('Source image not found in "%s"', $path));
        }

        try {
            $mimeType = $this->filesystem->mimeType($path);
        } catch (\LogicException $e) {
            // Mime Type could not be detected
            return $contents;
        }

        if (!$mimeType) {
            // Mime Type could not be detected
            return $contents;
        }

        return new Binary($contents, $mimeType);
    }
}
