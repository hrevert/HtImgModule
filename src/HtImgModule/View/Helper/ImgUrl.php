<?php

namespace HtImgModule\View\Helper;

use Zend\View\Helper\AbstractHelper;
use HtImgModule\Service\ImgUrlProviderInterface;
use HtImgModule\Options\CacheOptionsInterface;
use HtImgModule\Service\CacheManager;

class ImgUrl extends AbstractHelper
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
     * Constructor
     * 
     * @param CacheManager $cacheManager
     * @param CacheOptionsInterface $cacheOptions
     */
    public function __construct(CacheManager $cacheManager, CacheOptionsInterface $cacheOptions)
    {
        $this->cacheManager = $cacheManager;
        $this->cacheOptions = $cacheOptions;
    }
        
    public function __invoke($relativeName, $filter)
    {
        if ($this->cacheOptions->getEnableCache() && $this->cacheManager->cacheExists($relativeName, $filter)) {
            return $this->getView()->basePath() . '/'. $this->cacheManager->getCacheUrl($relativeName, $filter);
        }
        return $this->getView()->url('htimg/display', array('filter' => $filter), array('query' => array('relativePath' => $relativeName)));
    }
}
