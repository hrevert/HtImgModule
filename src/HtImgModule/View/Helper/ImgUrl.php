<?php

namespace HtImgModule\View\Helper;

use Zend\View\Helper\AbstractHelper;
use HtImgModule\Service\ImgUrlProviderInterface;

class ImgUrl extends AbstractHelper
{    
    public function __invoke($relativeName, $filter = null)
    {
        $this->getView()->url('htimg/display', array('relativeName' => $relativeName, 'filter' => $relativeName));
    }
}
