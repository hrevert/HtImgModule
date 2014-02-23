<?php

namespace HtImgModule\Imagine\Filter\Loader;

use Imagine\Filter\Basic\Resize;
use Imagine\Image\Box;

class ResizeFilter implements LoaderInterface
{
    /**
     * 
     */
    public function load(array $options = array())
    {
        $width = $options['width'];
        $height = $options['height'];   

        return new Resize(new Box($width, $height));
    }
}
