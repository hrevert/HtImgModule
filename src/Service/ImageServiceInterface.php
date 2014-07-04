<?php
namespace HtImgModule\Service;

interface ImageServiceInterface
{
    /**
     * Gets filtered image
     * Creates cache
     *
     * @param  string $relativePath
     * @param  string $filter
     * @return array
     */
    public function getImage($relativePath, $filter);
}
