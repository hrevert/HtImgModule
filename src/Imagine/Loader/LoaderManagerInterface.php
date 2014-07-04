<?php
namespace HtImgModule\Imagine\Loader;

use HtImgModule\Binary\BinaryInterface;

interface LoaderManagerInterface
{
    /**
     * Loads image from relative path, applies filter and returns binary
     *
     * @param  string                                        $relativePath
     * @param  string                                        $filter
     * @return BinaryInterface
     * @throws \HtImgModule\Exception\ImageNotFoundException
     */
    public function loadBinary($relativePath, $filter);
}
