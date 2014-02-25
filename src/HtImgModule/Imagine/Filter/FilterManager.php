<?php
namespace HtImgModule\Imagine\Filter;

use HtImgModule\Exception;
use HtImgModule\Options\FilterOptionsInterface;
use Imagine\Image\ImageInterface;

class FilterManager implements FilterManagerInterface
{
    /**
     * @var FilterOptionsInterface
     */
    protected $filterOptions;

    /**
     * @var FilterLoaderPluginManager
     */
    protected $filterLoaderPluginManager;

    /**
     * Constructor
     *
     * @param FilterOptionsInterface $filterOptions
     */
    public function __construct(
        FilterOptionsInterface $filterOptions,
        Loader\FilterLoaderPluginManager $filterLoaderPluginManager
    )
    {
        $this->filterOptions = $filterOptions;
        $this->filterLoaderPluginManager = $filterLoaderPluginManager;
    }

    /**
     * {@inheritDoc}
     */
    public function getFilter($filter)
    {
        $this->validateFilter($filter);
        $options = $this->filterOptions->getFilters()[$filter];

        return $this->filterLoaderPluginManager->get($options['type'])->load($options['options']);
    }

    /**
     * {@inheritDoc}
     */
    public function getFilterOptions($filter)
    {
        $this->validateFilter($filter);
        $options = $this->filterOptions->getFilters()[$filter];

        return $options['options'];
    }

    /**
     * Validates if filter exists and is valid
     *
     * @param string $filter    Filter Alias
     * @throws  Exception\FilterNotFoundException
     * @throws Exception\InvalidArgumentException
     * @return void
     */
    protected function validateFilter($filter)
    {
        if (!isset($this->filterOptions->getFilters()[$filter])) {
            throw new Exception\FilterNotFoundException(sprintf(
                'Filter "%s" was not found', $filter
            ));            
        }
        $options = $this->filterOptions->getFilters()[$filter];
        if (!isset($options['type'])) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Filter type for "%s" image filter must be specified', $filter
            ));
        }
        if (!isset($options['options'])) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Options for filter type "%s" must be specified', $filter
            ));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function applyFilter(ImageInterface $image, $filter)
    {
        return $this->getFilter($filter)->apply($image);
    }

    /**
     * {@inheritDoc}
     */
    public function addFilter($name, array $options)
    {
        $this->filterOptions->addFilter($name, $options);

        return $this;
    }
}
