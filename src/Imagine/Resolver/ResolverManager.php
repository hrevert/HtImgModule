<?php
namespace HtImgModule\Imagine\Resolver;

use HtImgModule\Imagine\Resolver\Factory\ImageMapResolverFactory;
use HtImgModule\Imagine\Resolver\Factory\ImagePathStackResolverFactory;
use Zend\ServiceManager\AbstractPluginManager;
use HtImgModule\Exception;
use Zend\ServiceManager\Exception\InvalidServiceException;

class ResolverManager extends AbstractPluginManager
{
    protected $instanceOf = ResolverInterface::class;
    /**
     * @var array
     */
    protected $aliases = [
        'image_path_stack' => 'imagepathstack',
        'imagePathStack' => 'imagepathstack',
        'ImagePathStack' => 'imagepathstack',
        'image_map' => 'imagemap',
        'imageMap' => 'imagemap',
        'ImageMap' => 'imagemap',
    ];

    protected $factories  = [
        'imagemap' => ImageMapResolverFactory::class,
        'imagepathstack' => ImagePathStackResolverFactory::class,
    ];

    public function validate($instance)
    {
        if (! $instance instanceof $this->instanceOf) {
            throw new InvalidServiceException(sprintf(
                'Invalid plugin "%s" created; not an instance of %s',
                get_class($instance),
                $this->instanceOf
            ));
        }
    }

    /**
     * Checks if $plugin is instance of ResolverInterface
     *
     * @param  mixed $instance
     * @return void
     * @throws Exception\InvalidArgumentException
     */
    public function validatePlugin($instance)
    {
        try {
            $this->validate($instance);
        } catch (InvalidServiceException $e) {
            throw new Exception\InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
