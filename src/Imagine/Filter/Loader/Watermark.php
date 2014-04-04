<?php
namespace HtImgModule\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Watermark as WatermarkFilter;

class Watermark extends Paste implements LoaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $options = array())
    {
        $size = (isset($options['width']) && isset($options['height']) )
            ? [$options['width'], $options['height']]
            : null;

        return new WatermarkFilter(
            $this->imagine->open($this->resolver->resolve($options['watermark'])),
            $size,
            isset($options['position']) ? $options['position'] : 'center'
        );
    }
}
