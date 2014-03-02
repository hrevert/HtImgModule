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
    public function cacheExists($relativeName, $filter, $format = null)
    {
        $cachePath = $this->getCachePath($relativeName, $filter, $format);
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
    public function getCacheUrl($relativeName, $filter, $format = null)
    {
        if (!$format) {
             return $this->cacheOptions->getCachePath() . '/' . $filter . '/'. $relativeName;
        } else {
            return $this->getCacheUrl($relativeName, $filter) . '.' . $format;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getCachePath($relativeName, $filter, $format = null)
    {
        return $this->cacheOptions->getWebRoot() . '/' . $this->getCacheUrl($relativeName, $filter, $format);
    }

    /**
     * {@inheritDoc}
     */
    public function createCache($relativeName, $filter, ImageInterface $image, $format = null)
    {
        $cachePath = $this->getCachePath($relativeName, $filter, $format);
        if (!is_dir(dirname($cachePath))) {
            mkdir(dirname($cachePath), 0755, true);
        }
        $image->save($cachePath);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteCache($relativeName, $filter, $format = null)
    {
        $cachePath = $this->getCachePath($relativeName, $filter, $format);
        if (is_readable($cachePath)) {
            unlink($cachePath);
        }
    }
}
