<?php
namespace HtImgModule\Factory\Imagine\Loader;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Loader\SimpleFileSystemLoader;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use HtImgModule\Exception;

class SimpleFileSystemLoaderFactory implements FactoryInterface, MutableCreationOptionsInterface
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * {@inheritDoc}
     */
    public function setCreationOptions(array $options)
    {
        $this->options = $options;
    }

    public function createService(ServiceLocatorInterface $loaders)
    {
        if (!isset($this->options['root_path'])) {
            throw new Exception\InvalidArgumentException('Missing "root_path" in options array');
        }

        return new SimpleFileSystemLoader($this->options['root_path']);
    }    
}
