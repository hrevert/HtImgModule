<?php
namespace HtImgModule\Service;

use Imagine\Image\ImagineInterface;
use HtImgModule\Options\CacheOptionsInterface;
use HtImgModule\Service\CacheManager;
use Zend\View\Resolver\AggregateResolver;

class ImageService
{
    /**
     * @var CacheOptionsInterface 
     */
    protected $cacheOptions;

    /**
     * @var CacheManager 
     */
    protected $cacheManager;

    /**
     * @var ImagineInterface 
     */
    protected $imagine;

    /**
     * @var AggregateResolver
     */
    protected $relativePathResolver;

    /**
     * @var FilterManager
     */
    protected $filterManager;

    /**
     * Constructor
     * 
     * @param CacheManager $cacheManager
     * @param CacheOptionsInterface $cacheOptions
     * @param ImagineInterface $imagine
     * @param FilterManager $filterManager
     */
    public function __construct(
        CacheManager $cacheManager, 
        CacheOptionsInterface $cacheOptions, 
        ImagineInterface $imagine,
        AggregateResolver $relativePathResolver,
        FilterManager $filterManager
    )
    {
        $this->cacheManager = $cacheManager;
        $this->cacheOptions = $cacheOptions;
        $this->imagine = $imagine;
        $this->relativePathResolver = $relativePathResolver;
    }

    /**
     * Gets image from relative path of image 
     *
     * @param string $relativePath
     * @param string $filter
     * @return \Imagine\Image\ImageInterface
     */
    public function getImageFromRelativePath($relativePath, $filter)
    {
        if ($this->cacheOptions->getEnableCache() && $this->cacheManager->cacheExists($relativePath, $filter)) {
            return $this->imagine->open($this->cacheManager->getCachePath($relativePath, $filter));
        }

        return $this->getImage($this->relativePathResolver->resolve($relativePath), $filter);
    }

    /**
     * Gets image from path of image 
     *
     * @param string $imagePath
     * @param string $filter
     * @return \Imagine\Image\ImageInterface
     */
    public function getImage($imagePath, $filter)
    {
        $image = $this->imagine->open($imagePath);
        $this->filterManager->getFilter($filter)->apply($image);

        return $image;        
    }
}
