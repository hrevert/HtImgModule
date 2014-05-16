<?php

namespace HtImgModule\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Resolver\ResolverInterface;
use HtImgModule\Options\CacheOptionsInterface;
use HtImgModule\Service\CacheManagerInterface;
use HtImgModule\Imagine\Filter\FilterManager;
use HtImgModule\Exception;

class ImgUrl extends AbstractHelper
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
     * @var FilterManager
     */
    protected $filterManager;

    /**
     * @var ResolverInterface
     */
    protected $relativePathResolver;

    /**
     * Constructor
     *
     * @param CacheManagerInterface $cacheManager
     * @param CacheOptionsInterface $cacheOptions
     * @param FilterManager         $filterManager
     */
    public function __construct(
        CacheManagerInterface $cacheManager,
        CacheOptionsInterface $cacheOptions,
        FilterManager $filterManager,
        ResolverInterface $relativePathResolver
    )
    {
        $this->cacheManager = $cacheManager;
        $this->cacheOptions = $cacheOptions;
        $this->filterManager = $filterManager;
        $this->relativePathResolver = $relativePathResolver;
    }

    /**
     * Gets url of image
     *
     * @param  string $relativeName Relative Path
     * @param  string $filter       Filter Alias
     * @return string
     */
    public function __invoke($relativeName, $filter)
    {
        $filterOptions = $this->filterManager->getFilterOptions($filter);
        if (isset($filterOptions['format'])) {
            $format = $filterOptions['format'];
        } else {
            $imagePath = $this->relativePathResolver->resolve($relativeName);
            $format = pathinfo($imagePath, PATHINFO_EXTENSION);
            $format = $format ?: 'png';
        }
        if ($this->cacheOptions->getEnableCache() && $this->cacheManager->cacheExists($relativeName, $filter, $format)) {
            $basePathHelper = $this->getView()->plugin('basePath');

            return $basePathHelper() . '/'. $this->cacheManager->getCacheUrl($relativeName, $filter, $format);
        }
        if (!isset($imagePath)) {
            $imagePath = $this->relativePathResolver->resolve($relativeName);
        }
        if (!$imagePath) {
            throw new Exception\ImageNotFoundException(
                sprintf('Unable to resolve %s', $relativeName)
            );
        }

        $urlHelper = $this->getView()->plugin('url');

        return $urlHelper('htimg/display', ['filter' => $filter], ['query' => ['relativePath' => $relativeName]]);
    }
}
