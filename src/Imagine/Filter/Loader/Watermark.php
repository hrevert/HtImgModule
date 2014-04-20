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
            isset($options['size']) ? $options['size'] : null,
            isset($options['position']) ? $options['position'] : 'center'
        );
    }
}
