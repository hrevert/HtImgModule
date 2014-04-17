<?php

namespace HtImgModule\Imagine\Filter\Loader;

use HtImgModule\Exception\InvalidArgumentException;
use Imagine\Filter\Advanced\RelativeResize as RelativeResizeFilter;

class RelativeResize implements LoaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $options = [])
    {
        foreach ($options as $method => $parameter) {
            return new RelativeResizeFilter($method, $parameter);
        }

        throw new InvalidArgumentException('Expected method/parameter pair, none given');
    }
}
