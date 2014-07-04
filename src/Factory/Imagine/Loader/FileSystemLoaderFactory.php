<?php
namespace HtImgModule\Factory\Imagine\Loader;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Loader\FileSystemLoader;

class FileSystemLoaderFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $loaders)
    {
        $resolver = $loaders->getServiceLocator()->get('HtImg\RelativePathResolver');

        return new FileSystemLoader($resolver);
    }
}
