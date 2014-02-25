<?php
namespace HtImgModule\Imagine\Filter\Loader;

use HtImgModule\Exception;
use HtImgModule\Imagine\Filter\FilterManager;
use HtImgModule\Imagine\Filter\Chain as ChainFilter;

class Chain implements LoaderInterface
{
    /**
     * @var FilterManager
     */
    protected $filterManager;

    /**
     * @param FilterManager $filterManager
     */
    public function __construct(FilterManager $filterManager)
    {
        $this->filterManager = $filterManager;
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $options = array())
    {
        if (false == isset($options['filters']) || false == is_array($options['filters'])) {
            throw new Exception\InvalidArgumentException('Expected filters key and type of array');
        }

        if (false == $options['filters']) {
            throw new Exception\InvalidArgumentException('At least one filter expected');
        }

        $filters = array();

        foreach ($options['filters'] as $loaderName => $loaderOptions) {
            $loader = $this->filterManager->getLoader($loaderName);
            $filters[] = $loader->load($loaderOptions);
        }

        return new ChainFilter($filters);

    }
}
