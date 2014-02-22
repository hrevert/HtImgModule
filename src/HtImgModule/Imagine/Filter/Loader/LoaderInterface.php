<?php

namespace HtImgModule\Imagine\Filter\Loader;

interface LoaderInterface
{
    /**
     * @param array $options
     *
     * @return \Imagine\Filter\FilterInterface
     */
    function load(array $options = array());    
}
