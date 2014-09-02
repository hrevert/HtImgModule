<?php
namespace HtImgModule\Service;

use Imagine\Image\ImageInterface;

interface CacheManagerInterface
{
    /**
     * Checks if cache exists
     *
     * @param  string      $relativeName
     * @param  string      $filter
     * @param  string|null $formatOrImage
     * @return bool
     */
    public function cacheExists($relativeName, $filter, $formatOrImage = null);

    /**
     * Gets browser url for a cache
     *
     * @param  string      $relativeName
     * @param  string      $filter
     * @param  string|null $formatOrImage
     * @return string
     */
    public function getCacheUrl($relativeName, $filter, $formatOrImage = null);

    /**
     * Gets filesystem path for a cache
     *
     * @param  string      $relativeName
     * @param  string      $filter
     * @param  string|null $formatOrImage
     * @return string
     */
    public function getCachePath($relativeName, $filter, $formatOrImage = null);

    /**
     * Creates a new cache
     *
     * @param  string         $relativeName
     * @param  string         $filter
     * @param  ImageInterface $image
     * @param  string|null    $formatOrImage
     * @return void
     */
    public function createCache($relativeName, $filter, ImageInterface $image, $formatOrImage = null);

    /**
     * Deletes a new cache
     *
     * @param  string      $relativeName
     * @param  string      $filter
     * @param  string|null $formatOrImage
     * @return void
     */
    public function deleteCache($relativeName, $filter, $formatOrImage = null);

    /**
     * Checks if caching is allowed for a given filter
     *
     * @param string $filter
     * @param array $filterOptions
     * @return bool
     */
    public function isCachingEnabled($filter, array $filterOptions);
}
