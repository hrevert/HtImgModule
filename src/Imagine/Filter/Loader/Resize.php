<?php

namespace HtImgModule\Imagine\Filter\Loader;

use Imagine\Filter\Basic\Resize as ResizeFilter;
use Imagine\Image\Box;

class Resize implements LoaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $options = [])
    {
        $width = $options['width'];
        $height = $options['height'];

        return new ResizeFilter(new Box($width, $height));
    }
}
