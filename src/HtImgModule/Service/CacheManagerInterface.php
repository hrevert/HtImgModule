<?php
namespace HtImgModule\Service;

use Imagine\Image\ImageInterface;

interface CacheManagerInterface
{
    /**
     * Checks if cache exists
     *
     * @param  string $relativeName
     * @param  string $filter
     * @param  string|null $format 
     * @return bool
     */
    public function cacheExists($relativeName, $filter, $format = null);

    /**
     * Gets browser url for a cache
     *
     * @param  string $relativeName
     * @param  string $filter
     * @param  string|null $format
     * @return string
     */
    public function getCacheUrl($relativeName, $filter, $format = null);

    /**
     * Gets filesystem path for a cache
     *
     * @param  string $relativeName
     * @param  string $filter
     * @param  string|null $format
     * @return string
     */
    public function getCachePath($relativeName, $filter, $format = null);

    /**
     * Creates a new cache
     *
     * @param  string         $relativeName
     * @param  string         $filter
     * @param  ImageInterface $image
     * @param  string|null $format
     * @return void
     */
    public function createCache($relativeName, $filter, ImageInterface $image, $format = null);

    /**
     * Deletes a new cache
     *
     * @param  string         $relativeName
     * @param  string         $filter
     * @param  string|null $format
     * @return void
     */
    public function deleteCache($relativeName, $filter, $format = null);
}
