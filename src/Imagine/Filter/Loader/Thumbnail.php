<?php

namespace HtImgModule\Imagine\Filter\Loader;

use Imagine\Image\Box;
use Imagine\Image\ManipulatorInterface;
use Imagine\Filter\Basic\Thumbnail as ThumbnailFilter;

class Thumbnail implements LoaderInterface
{
    public function load(array $options = [])
    {
        $mode = isset($options['mode']) && $options['mode'] === 'inset'  ?
            ManipulatorInterface::THUMBNAIL_INSET :
            ManipulatorInterface::THUMBNAIL_OUTBOUND;

        $width = $options['width'];
        $height = $options['height'];

        return new ThumbnailFilter(new Box($width, $height), $mode);
    }
}
