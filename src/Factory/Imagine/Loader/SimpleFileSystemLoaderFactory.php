<?php
namespace HtImgModule\Factory\Imagine\Loader;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Loader\SimpleFileSystemLoader;
use HtImgModule\Exception;

class SimpleFileSystemLoaderFactory implements FactoryInterface
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

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        if (!isset($options['root_path'])) {
            throw new Exception\InvalidArgumentException('Missing "root_path" in options array');
        }

        return new SimpleFileSystemLoader($options['root_path']);
    }

    public function createService(ServiceLocatorInterface $loaders)
    {
        return $this($loaders, SimpleFileSystemLoader::class, $this->options);
    }
}
