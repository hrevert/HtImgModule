<?php
namespace HtImgModule\Imagine\Loader;

use Zend\View\Resolver\ResolverInterface;

class FileSystemLoader implements LoaderInterface
{
    /**
     * @var ResolverInterface
     */
    protected $resolver;

    /**
     * @var SimpleFileSystemLoader
     */
    protected $loader;

    /**
     * Constructor
     *
     * @param ResolverInterface
     */
    public function __construct($resolver)
    {
        $this->resolver = $resolver;
        $this->loader = new SimpleFileSystemLoader('.');
    }

    /**
     * {@inheritDoc}
     */
    public function load($path)
    {
        $imagePath = $this->resolver->resolve($path);

        return $this->loader->load($imagePath);
    }
}
