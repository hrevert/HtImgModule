<?php
namespace HtImgModule\Imagine\Loader;

use HtImgModule\Imagine\Resolver\ResolverInterface;
use HtImgModule\Exception;

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
    public function __construct(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
        $this->loader   = new SimpleFileSystemLoader(null);
    }

    /**
     * {@inheritDoc}
     */
    public function load($path)
    {
        $imagePath = $this->resolver->resolve($path);

        if (!$imagePath) {
            throw new Exception\ImageNotFoundException(sprintf('Cound not resolve image, "%s"', $path));
        }

        return $this->loader->load($imagePath);
    }
}
