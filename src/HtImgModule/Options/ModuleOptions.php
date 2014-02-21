<?php
namespace HtImgModule\Options;

class ModuleOptions 
{
    protected $cachePrefix = 'media/cache';

    protected $imgSourcePaths = ['./'];

    protected $driver = 'gd';

    protected $filters = [];

    public function setCachePrefix($cachePrefix)
    {
        $this->cachePrefix = $cachePrefix;

        return $this;
    }

    public function getCachePrefix()
    {
        return $this->cachePrefix;
    }

    public function setImgSourcePaths(array $imgSourcePaths)
    {
        $this->imgSourcePaths = $imgSourcePaths;

        return $this;
    }

    public function getImgSourcePaths(array $imgSourcePaths)
    {
        return $this->imgSourcePaths
    }

    public function setDriver($driver)
    {
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
}
