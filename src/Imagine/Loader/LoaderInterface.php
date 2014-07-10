<?php
namespace HtImgModule\Imagine\Loader;

use HtImgModule\Binary\Binary;

interface LoaderInterface
{
    /**
     * Retrieve the Image represented by the given path.
     *
     * The path may be a file path on a filesystem, or any unique identifier among the storage engine implemented by this Loader.
     *
     * @param mixed $path
     * @throws \HtImgModule\Exception\ImageNotFoundException
     * @return Binary|string An image binary content
     */
    public function load($path);
}
