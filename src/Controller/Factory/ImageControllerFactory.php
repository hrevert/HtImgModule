<?php
namespace HtImgModule\Controller\Factory;

use HtImgModule\Service\ImageService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Controller\ImageController;

class ImageControllerFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return ImageController
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        if (!method_exists($container, 'configure')) {
            $container = $container->getServiceLocator();
        }

        /** @var \HtImgModule\Service\ImageService $imageService */
        $imageService = $container->get(ImageService::class);

        return new ImageController($imageService);
    }

    public function createService(ServiceLocatorInterface $controllers)
    {
        return $this($controllers, ImageController::class);
    }
}
