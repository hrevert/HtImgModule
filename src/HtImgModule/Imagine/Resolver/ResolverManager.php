<?php
namespace HtImgModule\Imagine\Resolver;

use Zend\ServiceManager\AbstractPluginManager;
use HtImgModule\Exception;

class ResolverManager  extends AbstractPluginManager
{
    protected $invokableClasses  = [
        'imagemap' => 'HtImgModule\Imagine\Resolver\ImageMapResolver',
        'imagepathstack' => 'HtImgModule\Imagine\Resolver\ImagePathStackResolver',
    ];

    public function validatePlugin($plugin)
    {
        if ($plugin instanceof ResolverInterface) {
            return; // we're okay
        }

        throw new Exception\InvalidArgumentException(sprintf(
            'Plugin of type %s is invalid; must implement HtImgModule\Imagine\Resolver\ResolverInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin))
        ));
    }
}
