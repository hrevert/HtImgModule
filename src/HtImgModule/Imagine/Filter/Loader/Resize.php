<?php

namespace HtImgModule\Imagine\Filter\Loader;

use Imagine\Filter\Basic\Resize;
use Imagine\Image\Box;

class ResizeFilterLoader implements LoaderInterface
{
    /**
     * 
     */
    public function load(array $options = array())
    {
        list($width, $height) = $options['size'];

        return new Resize(new Box($width, $height));
    }
}
