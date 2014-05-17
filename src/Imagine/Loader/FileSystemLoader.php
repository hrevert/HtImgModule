<?php
namespace HtImgModule\Imagine\Loader;

use Zend\View\Resolver\ResolverInterface;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as Adapter;

class FileSystemLoader implements LoaderInterface
{
    /**
     * @var ResolverInterface
     */
    protected $resolver;

    /**
     * @var Filesystem
     */
    protected $fiysystem;

    /**
     * Constructor
     *
     * @param ResolverInterface
     */
    public function __construct($resolver)
    {
        $this->resolver = $resolver;
        $this->fiysystem = new Filesystem(new Adapter('.'));
    }

    /**
     * {@inheritDoc}
     */
    public function load($path)
    {
        $imagePath = $this->resolver->resolve($path);

        return $this->fiysystem->read($imagePath);
    }
}
