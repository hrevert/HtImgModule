<?php
namespace HtImgModule\Imagine\Filter\Loader;

use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Filter\Basic\Crop as CropFilter;

class Crop implements LoaderInterface
{
    public function load(array $options = [])
    {
        list($x, $y) = $options['start'];
        $width = $options['width'];
        $height = $options['height'];

        return new CropFilter(new Point($x, $y), new Box($width, $height));
    }
}
