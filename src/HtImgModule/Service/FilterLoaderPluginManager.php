<?php
namespace HtImgModule\Service; 

use Zend\ServiceManager\AbstractPluginManager;
use HtImgModule\Imagine\Filter\Loader\LoaderInterface;
use HtImgModule\Exception;

class FilterLoaderPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'crop' => 'HtImgModule\Imagine\Filter\Loader\Crop',
        'relative_resize' => 'HtImgModule\Imagine\Filter\Loader\RelativeResize',
        'resize' => 'HtImgModule\Imagine\Filter\Loader\Resize',
        'thumbnail' => 'HtImgModule\Imagine\Filter\Loader\Thumbnail',
    );
    
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
