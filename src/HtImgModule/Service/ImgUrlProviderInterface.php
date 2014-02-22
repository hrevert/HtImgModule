<?php

namespace HtImgModule\Service;

interface ImgUrlProviderInterface
{
    public function getUrl($relativeName, $filter = null);
}
