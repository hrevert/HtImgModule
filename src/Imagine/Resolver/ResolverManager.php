<?php
namespace HtImgModule\Imagine\Resolver;

use Zend\ServiceManager\AbstractPluginManager;
use HtImgModule\Exception;

class ResolverManager extends AbstractPluginManager
{
    /**
     * @var array
     */
    protected $factories  = [
        'imagemap' => 'HtImgModule\Imagine\Resolver\Factory\ImageMapResolverFactory',
        'imagepathstack' => 'HtImgModule\Imagine\Resolver\Factory\ImagePathStackResolverFactory',
    ];

    /**
     * Checks if $plugin is instance of ResolverInterface
     *
     * @param  mixed                              $plugin
     * @return void
     * @throws Exception\InvalidArgumentException
     */
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
