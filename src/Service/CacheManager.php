<?php
namespace HtImgModule\Service;

use HtImgModule\Options\CacheOptionsInterface;
use Imagine\Image\ImageInterface;

class CacheManager implements CacheManagerInterface
{
    /**
     * @var CacheOptionsInterface
     */
    protected $cacheOptions;

    /**
     * Constructor
     *
     * @param CacheOptionsInterface $cacheOptions
     */
    public function __construct(CacheOptionsInterface $cacheOptions)
    {
        $this->cacheOptions = $cacheOptions;
    }

    /**
     * {@inheritDoc}
     */
    public function cacheExists($relativeName, $filter, $formatOrImage = null)
    {
        $cachePath = $this->getCachePath($relativeName, $filter, $formatOrImage);
        if (is_file($cachePath) && is_readable($cachePath)) {
            if ((time() - filemtime($cachePath)) < $this->cacheOptions->getCacheExpiry()) {
                return true;
            }
            unlink($cachePath);
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function getCacheUrl($relativeName, $filter, $formatOrImage = null)
    {
        if (is_readable($formatOrImage)) {
            $format = pathinfo($formatOrImage, PATHINFO_EXTENSION);
        } else {
            $format = $formatOrImage;
        }
        if (!$format) {
             return $this->cacheOptions->getCachePath() . '/' . $filter . '/'. $relativeName;
        } else {
            return $this->getCacheUrl($relativeName, $filter) . '.' . $format;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getCachePath($relativeName, $filter, $formatOrImage = null)
    {
        return $this->cacheOptions->getWebRoot() . '/' . $this->getCacheUrl($relativeName, $filter, $formatOrImage);
    }

    /**
     * {@inheritDoc}
     */
    public function createCache($relativeName, $filter, ImageInterface $image, $formatOrImage = null)
    {
        $cachePath = $this->getCachePath($relativeName, $filter, $formatOrImage);
        if (!is_dir(dirname($cachePath))) {
            mkdir(dirname($cachePath), 0755, true);
        }
        $image->save($cachePath);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteCache($relativeName, $filter, $formatOrImage = null)
    {
        $cachePath = $this->getCachePath($relativeName, $filter, $formatOrImage);
        if (is_readable($cachePath)) {
            unlink($cachePath);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function isCachingEnabled($filter, array $filterOptions)
    {
        if (isset($filterOptions['enable_cache'])) {
            return (bool) $filterOptions['enable_cache'];
        }

        return $this->cacheOptions->getEnableCache();
    }
}
