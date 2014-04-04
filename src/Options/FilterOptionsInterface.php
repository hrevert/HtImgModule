<?php
namespace HtImgModule\Options;

interface FilterOptionsInterface
{
    public function getFilters();

    public function getFilterLoaders();

    public function addFilter($filterName, array $filterOptions);
}
