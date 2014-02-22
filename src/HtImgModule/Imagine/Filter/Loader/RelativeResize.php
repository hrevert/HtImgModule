<?php

namespace HtImgModule\Imagine\Filter\Loader;

use HtImgModule\Exception\InvalidArgumentException;
use Imagine\Filter\Advanced\RelativeResize;

class RelativeResizeFilterLoader implements LoaderInterface
{
    /**
     * 
     */
    public function load(array $options = array())
    {
        foreach ($options as $method => $parameter) {
            return new RelativeResize($method, $parameter);
        }

        throw new InvalidArgumentException('Expected method/parameter pair, none given');
    }
}
