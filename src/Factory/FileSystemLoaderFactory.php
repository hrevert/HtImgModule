<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Loader\FileSystemLoader;

class FileSystemLoaderFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $resolver = $serviceLocator->get('HtImg\RelativePathResolver');

        return new FileSystemLoader($resolver);
    }    
}
