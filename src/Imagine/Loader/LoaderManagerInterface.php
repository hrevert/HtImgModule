<?php
namespace HtImgModule\Imagine\Loader;

interface LoaderManagerInterface
{
    /**
     *
     * @throws \HtImgModule\Exception\ImageNotFoundException
     */
    public function getBinary($relativePath, $filter);
}
