<?php
namespace HtImgModule\Imagine\Filter;

use Imagine\Image\ImageInterface;

interface FilterManagerInterface
{
    /**
     * Gets a filter
     *
     * @param  string                                          $filter
     * @return Imagine\Filter\FilterInterface
     * @throws \HtImgModule\Exception\FilterNotFoundException
     * @throws \HtImgModule\Exception\InvalidArgumentException
     */
    public function getFilter($filter);

    /**
     * Applies a filter to a image and gives the new image
     *
     * @param ImageInterface $filter
     * @param string         $filter
     */
    public function applyFilter(ImageInterface $image, $filter);

    /**
     * Adds a new Filter
     *
     * @param  string $name
     * @param  array  $options
     * @return self
     */
    public function addFilter($name, array $options);

    /**
     * Gets a filter
     *
     * @param  string                                          $filter
     * @return array
     * @throws \HtImgModule\Exception\FilterNotFoundException
     * @throws \HtImgModule\Exception\InvalidArgumentException
     */
    public function getFilterOptions($filter);
}
