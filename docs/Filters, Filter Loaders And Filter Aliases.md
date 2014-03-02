Filters, Filter Loaders And Filter Aliases
=========================================

# Filters
Filter are classes that do the basic image manipulation operations as described [here](http://imagine.readthedocs.org/en/latest/usage/filters.html).
A filter must implement [Imagine\Filter\FilterInterface](https://github.com/avalanche123/Imagine/blob/develop/lib/Imagine/Filter/FilterInterface.php). The only required method is `apply` which does the image manipulation operation. This module comes with a lot of built in filters. See [here](https://github.com/avalanche123/Imagine/tree/develop/lib/Imagine/Filter) and [here](https://github.com/hrevert/HtImgModule/tree/master/src/HtImgModule/Imagine/Filter).

## Filters Aliases
Filter Aliases are quick and easy way to access filters from view helpers. For example,
```php
echo $this->htDisplayImage('relative/path/to/image', 'filter_alias');// Here it is
```
## Filter Loaders
Filter Loaders loads a filter by providing the options of a filter aliases to a filter. Filter loader must implement [HtImgModule\Imagine\Filter\Loader\LoaderInterface](https://github.com/hrevert/HtImgModule/blob/master/src/HtImgModule/Imagine/Filter/Loader/LoaderInterface.php). The only required method is `load`.

[Filters Usage](https://github.com/hrevert/HtImgModule/blob/master/docs/Using%20Filters.md)
