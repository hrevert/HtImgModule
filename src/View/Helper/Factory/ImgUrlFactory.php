<?php
namespace HtImgModule\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use HtImgModule\View\Helper\ImgUrl;

class ImgUrlFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $helpers)
    {
        $serviceLocator = $helpers->getServiceLocator();

        return new ImgUrl(
            $serviceLocator->get('HtImgModule\Service\CacheManager'),
            $serviceLocator->get('HtImgModule\Imagine\Filter\FilterManager'),
            $serviceLocator->get('HtImgModule\Imagine\Loader\LoaderManager')
        );
    }
}
