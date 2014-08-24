<?php
namespace HtImgModule\Imagine\Loader;

use HtImgModule\Exception;
use HtImgModule\Binary\Binary;

class SimpleFileSystemLoader implements LoaderInterface
{
    /**
     * @var string
     */
    protected $rootPath;

    /**
     * Constructor
     *
     * @param string
     */
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    /**
     * {@inheritDoc}
     */
    public function load($path)
    {
        if (false !== strpos($path, '../')) {
            throw new Exception\InvalidArgumentException(
                sprintf('Source image was searched with "%s" out side of the defined root path', $path)
            );
        }

        if ($this->rootPath === null) {
            $absolutePath = $path;
        } else {
            $absolutePath = $this->rootPath . '/' . ltrim($path, '/');
        }        

        if (!file_exists($absolutePath)) {
            throw new Exception\ImageNotFoundException(sprintf('Source image not found in "%s"', $absolutePath));
        }

        $contents = file_get_contents($absolutePath);

        if (!function_exists('exif_imagetype')) {
            return $contents;
        }

        $extension = pathinfo($absolutePath, PATHINFO_EXTENSION);
        $mimeType  = image_type_to_mime_type(exif_imagetype($absolutePath));

        return new Binary($contents, $mimeType, $extension);
    }
}
