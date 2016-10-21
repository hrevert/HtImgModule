<?php
namespace HtImgModule\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser as SymfonyMimeTypeGuesser;
use HtImgModule\Binary\MimeTypeGuesser;

class MimeTypeGuesserFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return MimeTypeGuesser
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $symfonyMimeTypeGuesser = SymfonyMimeTypeGuesser::getInstance();

        return new MimeTypeGuesser($symfonyMimeTypeGuesser);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, MimeTypeGuesser::class);
    }
}
