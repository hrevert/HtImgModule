<?php
namespace HtImgModule\Imagine\Filter\Loader;

use Imagine\Image\ImagineInterface;
use HtImgModule\Imagine\Filter\Paste as PasteFilter;
use HtImgModule\Exception;
use Zend\View\Resolver\ResolverInterface;

class Paste implements LoaderInterface
{
    /**
     * @var ImagineInterface
     */
    protected $imagine;

    /**
     * @var ResolverInterface
     */
    protected $resolver;

    /**
     * Constructor
     *
     * @param ImagineInterface  $imagine
     * @param ResolverInterface $resolver
     */
    public function __construct(ImagineInterface $imagine, ResolverInterface $resolver)
    {
        $this->imagine = $imagine;
        $this->resolver = $resolver;
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $options = [])
    {
        if (!isset($options['image'])) {
            throw new Exception\InvalidArgumentException('Option "image" is required.');
        }

        $x = isset($options['x']) ? $options['x'] : 0;
        $y = isset($options['y']) ? $options['y'] : 0;

        $path = $this->resolver->resolve($options['image']);

        if (!$path) {
            throw new Exception\RuntimeException(sprintf('Could not resolve %s', $options['image']));
        }

        $image = $this->imagine->open($path);

        return new PasteFilter($image, $x, $y);
    }
}
