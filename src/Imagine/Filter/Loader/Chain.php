<?php
namespace HtImgModule\Imagine\Filter\Loader;

use HtImgModule\Exception;
use HtImgModule\Imagine\Filter\Chain as ChainFilter;
use Zend\ServiceManager\ServiceLocatorInterface;

class Chain implements LoaderInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $filterLoaders;

    /**
     * @param ServiceLocatorInterface $filterLoaders
     */
    public function __construct(ServiceLocatorInterface $filterLoaders)
    {
        $this->filterLoaders = $filterLoaders;
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $options = [])
    {
        if (false == isset($options['filters']) || false == is_array($options['filters'])) {
            throw new Exception\InvalidArgumentException('Expected filters key and type of array');
        }

        if (false == $options['filters']) {
            throw new Exception\InvalidArgumentException('At least one filter expected');
        }

        $filters = [];

        foreach ($options['filters'] as $loaderName => $loaderOptions) {
            $loader = $this->filterLoaders->get($loaderName);
            $filters[] = $loader->load($loaderOptions);
        }

        return new ChainFilter($filters);

    }
}
