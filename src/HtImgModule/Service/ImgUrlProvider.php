<?php
namespace HtImgModule\Service;

use HtImgModule\Options\CacheOptionsInterface;

class ImgUrlProvider implements ImgUrlProviderInterface
{
    const URl = 'htimg/';

    protected $options;

    public function __construct(CacheOptionsInterface $options)
    {
        $this->options = $options;
    }

    public function getUrl($relativeName, $filter = null)
    {
        $relativeName = rawurlencode($relativeName);
        $filter = rawurlencode($filter);
        if (!$this->options->getEnableCache()) {
             return static::URl . $relativeName .'/' . $filter;
        }
        return static::URl . $this->options->getCachePrefix() . $relativeName;
    }
}
