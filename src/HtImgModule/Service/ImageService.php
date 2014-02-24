<?php
namespace HtImgModule\Service;

use Imagine\Image\ImagineInterface;
use HtImgModule\Options\CacheOptionsInterface;
use Zend\View\Resolver\AggregateResolver;
use HtImgModule\Imagine\Filter\FilterManagerInterface;

class ImageService
{
    /**
     * @var CacheOptionsInterface
     */
    protected $cacheOptions;

    /**
     * @var CacheManagerInterface
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
     * @var FilterManagerInterface
     */
    protected $filterManager;

    /**
     * Constructor
     *
     * @param CacheManagerInterface  $cacheManager
     * @param CacheOptionsInterface  $cacheOptions
     * @param ImagineInterface       $imagine
     * @param FilterManagerInterface $filterManager
     */
    public function __construct(
        CacheManagerInterface $cacheManager,
        CacheOptionsInterface $cacheOptions,
        ImagineInterface $imagine,
        AggregateResolver $relativePathResolver,
        FilterManagerInterface $filterManager
    )
    {
        $this->cacheManager = $cacheManager;
        $this->cacheOptions = $cacheOptions;
        $this->imagine = $imagine;
        $this->filterManager = $filterManager;
        $this->relativePathResolver = $relativePathResolver;
    }

    /**
     * Gets image from relative path of image
     *
     * @param  string                        $relativePath
     * @param  string                        $filter
     * @return \Imagine\Image\ImageInterface
     */
    public function getImageFromRelativePath($relativePath, $filter)
    {
        if ($this->cacheOptions->getEnableCache() && $this->cacheManager->cacheExists($relativePath, $filter)) {
            return $this->imagine->open($this->cacheManager->getCachePath($relativePath, $filter));
        }

        $imagePath = $this->relativePathResolver->resolve($relativePath);
        $image = $this->getImage($imagePath, $filter);
        if ($this->cacheOptions->getEnableCache()) {
            $this->cacheManager->createCache($relativePath, $filter, $image);
        }

        return $image;
    }

    /**
     * Gets image from path of image
     *
     * @param  string                        $imagePath
     * @param  string                        $filter
     * @return \Imagine\Image\ImageInterface
     */
    public function getImage($imagePath, $filter)
    {
        $image = $this->imagine->open($imagePath);

        return $this->filterManager->getFilter($filter)->apply($image);
    }
}
