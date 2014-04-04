<?php
namespace HtImgModule\Imagine\Filter\Loader;

use Zend\ServiceManager\AbstractPluginManager;
use HtImgModule\Exception;

class FilterLoaderPluginManager extends AbstractPluginManager
{
    protected $invokableClasses  = [
        'crop' => 'HtImgModule\Imagine\Filter\Loader\Crop',
        'relativeresize' => 'HtImgModule\Imagine\Filter\Loader\RelativeResize',
        'resize' => 'HtImgModule\Imagine\Filter\Loader\Resize',
        'thumbnail' => 'HtImgModule\Imagine\Filter\Loader\Thumbnail',
    ];

    protected $factories = [
        'chain' => 'HtImgModule\Imagine\Filter\Loader\Factory\ChainFactory',
        'paste' => 'HtImgModule\Imagine\Filter\Loader\Factory\PasteFactory',
        'watermark' => 'HtImgModule\Imagine\Filter\Loader\Factory\WatermarkFactory',
        'background' => 'HtImgModule\Imagine\Filter\Loader\Factory\BackgroundFactory',
    ];

    public function validatePlugin($plugin)
    {
        if ($plugin instanceof LoaderInterface) {
            return; // we're okay
        }

        throw new Exception\InvalidArgumentException(sprintf(
            'Plugin of type %s is invalid; must implement HtImgModule\Imagine\Filter\Loader\LoaderInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin))
        ));
    }
}
