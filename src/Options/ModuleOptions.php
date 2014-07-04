<?php
namespace HtImgModule\Options;

use HtImgModule\Exception;
use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements CacheOptionsInterface, FilterOptionsInterface
{
    protected $__strictMode__ = false;

    protected $enableCache = true;

    protected $imgSourcePathStack = [];

    protected $imgSourceMap = [];

    protected $driver = 'gd';

    protected $filters = [];

    protected $webRoot = 'public';

    protected $imageResolvers = [];

    protected $allowedDrivers = [
        'gd',
        'imagick',
        'gmagick',
    ];

    protected $filterLoaders = [];

    protected $cachePath = 'htimg';

    protected $cacheExpiry = 86400;

    protected $defaultImageLoader = 'FileSystem';

    public function setEnableCache($enableCache)
    {
        $this->enableCache = (bool) $enableCache;

        return $this;
    }

    public function getEnableCache()
    {
        return $this->enableCache;
    }

    public function setImgSourcePathStack(array $imgSourcePathStack)
    {
        $this->imgSourcePathStack = $imgSourcePathStack;

        return $this;
    }

    public function getImgSourcePathStack()
    {
        return $this->imgSourcePathStack;
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
                    '%s expects parameter 1 to one of %s, %s provided instead',
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

    public function addFilter($filterName, array $filterOptions)
    {
        $this->filters[$filterName] = $filterOptions;

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

    public function setFilterLoaders(array $filterLoaders)
    {
        $this->filterLoaders = $filterLoaders;

        return $this;
    }

    public function getFilterLoaders()
    {
        return $this->filterLoaders;
    }

    public function setCachePath($cachePath)
    {
        $this->cachePath = $cachePath;

        return $this;
    }

    public function getCachePath()
    {
        return $this->cachePath;
    }

    public function setCacheExpiry($cacheExpiry)
    {
        $this->cacheExpiry = (int) $cacheExpiry;

        return $this;
    }

    public function getCacheExpiry()
    {
        return $this->cacheExpiry;
    }

    public function setImageResolvers(array $imageResolvers)
    {
        $this->imageResolvers = $imageResolvers;
    }

    public function getImageResolvers()
    {
        return $this->imageResolvers;
    }

    public function setDefaultImageLoader($defaultImageLoader)
    {
        $this->defaultImageLoader = $defaultImageLoader;
    }

    public function getDefaultImageLoader()
    {
        return $this->defaultImageLoader;
    }
}
