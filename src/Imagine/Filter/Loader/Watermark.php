<?php
namespace HtImgModule\Imagine\Filter\Loader;

use HtImgModule\Imagine\Filter\Watermark as WatermarkFilter;

class Watermark extends Paste implements LoaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $options = [])
    {
        return new WatermarkFilter(
            $this->imagine->open($this->resolver->resolve($options['watermark'])),
            $options['size'],
            isset($options['position']) ? $options['position'] : 'center'
        );
    }
}
