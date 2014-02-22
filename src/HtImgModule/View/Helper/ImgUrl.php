<?php

namespace HtImgModule\View\Helper;

use Zend\View\Helper\AbstractHelper;
use HtImgModule\Service\ImgUrlProviderInterface;

class ImgUrl extends AbstractHelper
{
    protected $imgUrlProvider;

    public function __construct(ImgUrlProviderInterface $imgUrlProvider)
    {
        $this->imgUrlProvider = $imgUrlProvider;
    }
    
    public function __invoke($relativeName, $filter = null)
    {
        return $this->imgUrlProvider->getUrl($relativeName, $filter);
    }
}
