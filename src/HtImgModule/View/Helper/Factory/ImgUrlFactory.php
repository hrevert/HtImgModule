<?php
namespace HtImgModule\View\Helper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\View\Helper\ImgUrl;

class ImgUrlFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $helpers)
    {
        $imgUrlProvider = $helpers->getServiceLocator()->get('HtImg\UrlProvider');

        return new ImgUrl($imgUrlProvider);
    }
}
