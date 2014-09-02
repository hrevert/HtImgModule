<?php

namespace HtImgModule\View\Helper;

use Zend\View\Helper\AbstractHelper;
use HtImgModule\Service\CacheManagerInterface;
use HtImgModule\Imagine\Filter\FilterManagerInterface;
use HtImgModule\Exception;
use HtImgModule\Imagine\Loader\LoaderManagerInterface;

class ImgUrl extends AbstractHelper
{
    /**
     * @var CacheManagerInterface
     */
    protected $cacheManager;

    /**
     * @var FilterManagerInterface
     */
    protected $filterManager;

    /**
     * @var LoaderManagerInterface
     */
    protected $loaderManager;

    /**
     * Constructor
     *
     * @param CacheManagerInterface  $cacheManager
     * @param FilterManagerInterface $filterManager
     * @param LoaderManagerInterface $loaderManager
     */
    public function __construct(
        CacheManagerInterface $cacheManager,
        FilterManagerInterface $filterManager,
        LoaderManagerInterface $loaderManager
    )
    {
        $this->cacheManager = $cacheManager;
        $this->filterManager = $filterManager;
        $this->loaderManager = $loaderManager;
    }

    /**
     * Gets url of image
     *
     * @param  string $relativeName Relative Path
     * @param  string $filter       Filter Service
     * @return string
     */
    public function __invoke($relativeName, $filter)
    {
        $filterOptions = $this->filterManager->getFilterOptions($filter);
        if (isset($filterOptions['format'])) {
            $format = $filterOptions['format'];
        } else {
            $binary = $this->loaderManager->loadBinary($relativeName, $filter);
            $format = $binary->getFormat() ?: 'png';
        }
        if ($this->cacheManager->isCachingEnabled($filter, $filterOptions) && $this->cacheManager->cacheExists($relativeName, $filter, $format)) {
            $basePathHelper = $this->getView()->plugin('basePath');

            return $basePathHelper() . '/'. $this->cacheManager->getCacheUrl($relativeName, $filter, $format);
        }

        $urlHelper = $this->getView()->plugin('url');

        return $urlHelper('htimg/display', ['filter' => $filter], ['query' => ['relativePath' => $relativeName]]);
    }
}
