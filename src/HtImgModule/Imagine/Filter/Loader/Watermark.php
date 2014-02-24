<?php
namespace HtImgModule\Imagine\Filter\Loader;

use HtImgModule\Exception;
use HtImgModule\Imagine\Filter\Watermark as WatermarkFilter;

class Watermark extends Paste implements LoaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $options = array())
    {
        $options += array(
            'size' => null,
            'position' => 'center'
        );

        return new WatermarkFilter(
            $this->imagine->open($this->resolver->load($options['watermark'])),
            $options['size'],
            $options['position']
        );
    }    
}
