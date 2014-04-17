<?php
namespace HtImgModule\Imagine\Filter;

use Imagine\Filter\FilterInterface;
use Imagine\Image\ImageInterface;
use HtImgModule\Exception;

class Chain implements FilterInterface
{

    /**
     * @var \Imagine\Filter\FilterInterface[]
     */
    protected $filters;

    /**
     * @param \Imagine\Filter\FilterInterface[] $filters
     *
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(array $filters)
    {
        foreach ($filters as $filter) {
            if (!$filter instanceof FilterInterface) {
                throw new Exception\InvalidArgumentException('Instance of Imagine\\Filter\\FilterInterface expected');
            }
        }

        $this->filters = $filters;
    }

    /**
     * {@inheritDoc}
     */
    public function apply(ImageInterface $image)
    {
        /** @var $filter \Imagine\Filter\FilterInterface */
        foreach ($this->filters as $filter) {
            $image = $filter->apply($image);
        }

        return $image;
    }
}
