<?php
namespace HtImgModule\Imagine\Filter\Loader;

use Imagine\Image\ImagineInterface;
use HtImgModule\Imagine\Filter\Background as BackgroundFilter;
use HtImgModule\Exception;

class Background extends Paste implements LoaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $options = array())
    {
        $size = (isset($options['width']) && isset($options['height']) )
            ? [$options['width'], $options['height']] 
            : null;
        return new BackgroundFilter(
            $this->imagine->open($this->resolver->load($options['image'])),
            $size,
            isset($options['color']) ? $options['color'] : '#fff'
        ); 
    }
}
