<?php
namespace HtImgModule\Service; 

use Imagine\Image\ImageInterface;

interface CacheManagerInterface
{
    /**
     * Checks if cache exists
     *
     * @param string $relativeName 
     * @param string $filter 
     * @return bool
     */
    public function cacheExists($relativeName, $filter);
    
    /**
     * Gets browser url for a cache
     *
     * @param string $relativeName 
     * @param string $filter 
     * @return string
     */    
    public function getCacheUrl($relativeName, $filter);
    
    /**
     * Gets filesystem path for a cache
     *
     * @param string $relativeName 
     * @param string $filter 
     * @return string
     */    
    public function getCachePath($relativeName, $filter);
    
    /**
     * Creates a new cache
     *
     * @param string $relativeName 
     * @param string $filter 
     * @param ImageInterface $image
     * @return void
     */     
    public function createCache($relativeName, $filter, ImageInterface $image);                
}
