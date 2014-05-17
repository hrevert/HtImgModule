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
     * Constructor
     *
     * @param ResolverInterface
     */
    public function __construct($resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * {@inheritDoc}
     */
    public function load($path)
    {
        $imagePath = $this->resolve->resolve($path);

        return file_get_contents($imagePath);
    }
}
