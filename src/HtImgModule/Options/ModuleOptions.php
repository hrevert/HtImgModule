<?php
namespace HtImgModule\Options;

use HtImgModule\Exception;

class ModuleOptions 
{
    protected $enableCache = true;

    protected $cachePrefix = 'media/cache';

    protected $imgSourcePathStack = ['./'];

    protected $imgSourceMap = [];

    protected $driver = 'gd';

    protected $filters = [];

    protected $webRoot = 'public';

    protected $allowedDrivers = [
        'gd',
        'imagick',
        'gmagick',
    ];

    public function setEnableCache($enableCache)
    {
        $this->enableCache = (bool) $enableCache;

        return $this;
    }

    public function getEnableCache()
    {
        return $this->enableCache;
    }

    public function setCachePrefix($cachePrefix)
    {
        $this->cachePrefix = $cachePrefix;

        return $this;
    }

    public function getCachePrefix()
    {
        return $this->cachePrefix;
    }

    public function setImgSourcePathStack(array $imgSourcePathStack)
    {
        $this->imgSourcePathStack = $imgSourcePathStack;

        return $this;
    }

    public function getImgSourcePathStack(array $imgSourcePathStack)
    {
        return $this->imgSourcePathStack
    }

    public function setImgSourceMap($imgSourceMap)
    {
        $this->imgSourceMap = $imgSourceMap;

        return $this;
    }

    public function getImgSourceMap()
    {
        return $this->imgSourceMap;
    }

    public function setDriver($driver)
    {
        $driver = strtolower($driver);
        if (!in_array($driver, $this->allowedDrivers)) {
            throw new Exception\InvalidArgumentException(
                sprintf(
                    '%s expects parameter 1 to one of %s, %s provided instead'
                    __METHOD__,
                    implode(', ', $this->allowedDrivers),
                    $driver
                )
            );
        }
        $this->driver = $driver;

        return $this;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    public function setFilters(array $filters)
    {
        $this->filters = $filters;

        return $this;
    }

    public function getFilters()
    {
        return $this->filters;
    }

    public function setWebRoot($webRoot)
    {
        $this->webRoot = $webRoot;

        return $this;
    }

    public function getWebRoot()
    {
        return $this->webRoot;
    }
}
