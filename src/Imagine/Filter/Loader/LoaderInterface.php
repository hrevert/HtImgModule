<?php

namespace HtImgModule\Imagine\Filter\Loader;

interface LoaderInterface
{
    /**
     * @param array $options
     *
     * @return \Imagine\Filter\FilterInterface
     */
    public function load(array $options = []);
}
