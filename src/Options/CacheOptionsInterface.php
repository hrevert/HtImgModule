<?php
namespace HtImgModule\Options;

interface CacheOptionsInterface
{
    public function getEnableCache();

    public function getWebRoot();

    public function getCachePath();
    
    public function getCacheUrl();

    public function getCacheExpiry();

}
