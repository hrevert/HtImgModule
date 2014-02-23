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
        $options = $serviceLocator->get('HtImg\ModuleOptions');
        $cacheManager = $serviceLocator->get('HtImgModule\Service\CacheManager');

        return new ImgUrl($cacheManager, $options);
    }
}
